<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\User;

class PayrollController extends Controller
{
    public function index()
    {

        $data = Payroll::with(['user','user.department'])->paginate(4);

        return view('admin.payroll.index', ['data' => $data]);
    }
    public function calculateSalary(User $user, $month, $baseMonthlySalary) {
        // Truy xuất dữ liệu bảng lương của người dùng trong tháng cụ thể
        $payroll = Payroll::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('month', $month)->first();
    
        if (!$payroll) {
            return response()->json(['error' => 'Không tìm thấy dữ liệu bảng lương cho người dùng và tháng được chỉ định.'], 404);
        }
    
        // Tính lương dựa trên ngày làm việc hợp lệ và không hợp lệ
        $totalWorkdays = $payroll->valid_workdays + $payroll->invalid_workdays;
        if ($totalWorkdays == 0) {
            return response()->json(['error' => 'Tổng số ngày làm việc không thể bằng không.'], 400);
        }
    
        $validPortion = ($payroll->valid_workdays / $totalWorkdays) * $baseMonthlySalary;
        $invalidPortion = ($payroll->invalid_workdays / $totalWorkdays) * ($baseMonthlySalary * 0.5);
        $salaryReceived = $validPortion + $invalidPortion;
    
        // Cập nhật bảng lương với mức lương đã tính toán
        $payroll->salary_received = $salaryReceived;
        $payroll->processed_by = auth()->user()->name; //giả sử một quản trị viên được xác thực xử lý nó
        $payroll->processed_at = now();
        $payroll->save();
    
        return response()->json([
            'message' => 'Đã tính lương thành công.',
            'salary_received' => $salaryReceived
        ]);
    }
    
}
