<?php

namespace App\Http\Controllers;

use App\Enums\LeaveStatusEnum;
use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Enums\DepartmentStatusEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Enums\AttendanceStatusEnum;
use App\Exports\PayrollExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SalaryLevel;

class PayrollController extends Controller
{
    public function index()
    {

        $data = Payroll::with(['user', 'user.department', 'salarylevel'])
            ->where('type', 'day')
            ->paginate(4);

        return view('admin.payroll.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $users = User::select('id', 'name')->get();
        $salaryLevels = SalaryLevel::select('id', 'level_name')->get();

        return view('admin.payroll.create', [
            'users' => $users,
            'salaryLevels' => $salaryLevels,
        ]);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $inputs = $request->only([
            'name',
            'level_name',
        ]);

        $payroll = Payroll::create($inputs);

        return redirect()->route('payrolls.index');
    }

    public function edit($id)
    {
        $data = Payroll::query()->findOrFail($id);

        return view('admin.payroll.update', [
            'data' => $data,
            'users' => User::select('id', 'name')->get() // Assuming 'User' model has 'id' and 'name' fields.
        ]);
    }

    public function saveEdit(Request $request, int $id)
    {
        // Define validation rules for payroll form fields
        $validator = Validator::make($request->all(), [
            'valid_workdays' => 'required|integer',
            'invalid_workdays' => 'required|integer',
            'month' => 'required|string', // Month as a string, e.g., "2024-10"
            'salary_received' => 'required|numeric',
            'updated_by' => 'required', // Ensure selected user exists

        ]);

        // If validation fails, return back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Collect inputs
        $inputs = $request->only([
            'valid_workdays',
            'invalid_workdays',
            'month',
            'salary_received',
            'updated_by',

        ]);

        // Set status based on checkbox
        $inputs['status'] = $request->has('status') ? DepartmentStatusEnum::ACTIVATED : DepartmentStatusEnum::DEACTIVATED;

        // Find and update payroll record
        $payroll = Payroll::query()->findOrFail($id);
        $payroll->fill($inputs)->update();

        // Redirect to payrolls index page after successful update
        return redirect()->route('payrolls.index');
    }


    public function calculateSalary(User $user, $validWorkdays)
    {
        $salaryLevel = $user->salaryLevel; // Lấy bậc lương của nhân viên
        if (!$salaryLevel) {
            return 0; // Nếu không có bậc lương, trả về 0 hoặc báo lỗi
        }

        // Tính lương
        $dailySalary = $validWorkdays * $salaryLevel->daily_rate; // Lương theo ngày
        $monthlySalary = $salaryLevel->monthly_rate; // Lương cố định theo tháng

        // Chọn cách tính phù hợp (ở đây ưu tiên theo ngày)
        return $dailySalary > 0 ? $dailySalary : $monthlySalary;
    }

    public function storePayroll()
    {
        $users = User::with('salaryLevel')->get(); // Lấy danh sách nhân viên và bậc lương
        $month = now()->format('Y-m'); // Lấy tháng hiện tại

        foreach ($users as $user) {
            $validWorkdays = $user->attendances()->whereMonth('date', now()->month)->count(); // Đếm ngày công hợp lệ
            $invalidWorkdays = 0; // Giả định chưa có logic xác định ngày không hợp lệ

            $salary = $this->calculateSalary($user, $validWorkdays); // Gọi hàm tính lương

            // Lưu vào bảng payrolls
            Payroll::create([
                'user_id' => $user->id,
                'valid_workdays' => $validWorkdays,
                'invalid_workdays' => $invalidWorkdays,
                'month' => $month,
                'salary_received' => $salary,

            ]);
        }

        return redirect()->route('payrolls.index')->with('success', 'Bảng lương đã được tạo thành công!');
    }

    public function updateWage()
    {
        $year = now()->year;
        $month = now()->month;

        $users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('is_system_role', '!=', true);
            })
            ->with([
                'attendances' => function ($query) use ($year, $month) {
                    $query->where('status', AttendanceStatusEnum::VALID)
                        ->whereBetween('check_in', [
                            Carbon::create($year, $month, day: 1)->startOfMonth(),
                            Carbon::create($year, $month, day: 1)->endOfMonth(),
                        ]);
                },
                'salaryLevel'
            ])
            ->with('proposals', function ($query) use ($year, $month) {
                $query->where('rest_type', 'Nghỉ không phép')
                    ->where('status', LeaveStatusEnum::ACCEPT)
                    ->where('from_date', '>=', Carbon::create($year, $month, day: 1)->startOfMonth());
            })
            ->get();

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        $workingDays = 0;

        // Calculate working days in the month
        while ($startDate->lte($endDate)) {
            if (!$startDate->isWeekend()) {
                $workingDays++;
            }
            $startDate->addDay();
        }

        foreach ($users as $user) {
            $validWorkdays = $user->attendances->count();
            $leaveWithoutLeave = 0;
            if ($user->salaryLevel) {

                if ($validWorkdays === 0) {
                    $validWorkdays = 0;
                    $salaryReceivedDay = 0;
                } else {
                    if ($user->proposals) {
                        foreach ($user->proposals as $proposal) {
                            if ($proposal->proposal_type_id === 'Nghỉ toàn ca') {
                                $from = Carbon::parse($proposal->from_date);
                                $to = Carbon::parse($proposal->to_date);
                                $days = $to->diffInDays($from);
                                if ($days > 0) {
                                    $leaveWithoutLeave = $days;
                                    $validWorkdays = $validWorkdays - $leaveWithoutLeave;
                                }
                            }
    
                            if ($proposal->proposal_type_id === 'Nghỉ nửa ca') {
                                $validWorkdays = $validWorkdays - 0.5;
                                $leaveWithoutLeave = $leaveWithoutLeave - 0.5;
                            }
                        }
                    }
                }

                $dailyRate = $user->salaryLevel->daily_rate;

                $salaryReceivedDay = $validWorkdays * $dailyRate; // Lương theo ngày
              

                $attributesDay = [
                    'user_id' => $user->id,
                    'month' => "$month-$year",
                    'type' => 'day',
                ];

                $valuesDay = [
                    'valid_workdays' => $validWorkdays,
                    'invalid_workdays' => $workingDays - $validWorkdays,
                    'salary_received' => $salaryReceivedDay,
                    'processed_by' => Auth::id(),
                    'leave_without_leave' => $leaveWithoutLeave,
                    'updated_at' => now('Asia/Ho_Chi_Minh'),
                ];

                PayRoll::updateOrCreate($attributesDay, values: $valuesDay);
            }
        }

        return back()->with('success', 'Cập nhật thành công!');
    }


    public function delete($id)
    {
        $data = Payroll::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }

    public function exportPayrolls()
    {
        return Excel::download(new PayrollExport, 'payrolls.xlsx');
    }
}
