<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceStatusEnum;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $now = now();
        $time = [
            'name' => $auth->name,
            'date' => $now->format('d/m/Y'),
            'day' => $now->locale('vi')->dayName
        ];
        $start_time = now()->setTime(8, 0, 0);
        $end_time = now()->setTime(17, 0, 0);

        // Paginate employee-specific data
        $data = Attendance::with(['user', 'user.department'])
            ->where('user_id', $auth->id)
            ->orderByDesc('date')
            ->paginate(4)
            ->through(function ($attendance) use ($start_time, $end_time) {
                return $this->processAttendanceData($attendance, $start_time, $end_time);
            });

        // Filter and paginate total data for admin
        $search = $request->input('search');
        $dataTotalsQuery = Attendance::with(['user', 'user.department']);

        if ($search) {
            $dataTotalsQuery->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })->orWhereHas('user.department', function ($query) use ($search) {
                    $query->where('room_name', 'LIKE', "%{$search}%");
                })->orWhere('date', 'LIKE', "%{$search}%");
            });
        }

        $dataTotals = $dataTotalsQuery
            ->orderByDesc('date')
            ->paginate(6)
            ->through(function ($attendance) use ($start_time, $end_time) {
                return $this->processAttendanceData($attendance, $start_time, $end_time);
            });

        $checkIn = Attendance::where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->whereNotNull('check_in')
            ->exists();

        $checkOut = Attendance::where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->whereNotNull('check_out')
            ->exists();

        return view('admin.dashboard', [
            'data' => $data,
            'dataTotals' => $dataTotals,
            'time' => $time,
            'checkIn' => !$checkIn,
            'checkOut' => !$checkOut,

        ]);

    }

    public function checkIn()
    {
        $auth = Auth::user();
        $now = now();
        $start_time = now()->setTime(8, 0, 0);

        // Check if user already checked in today
        $check = Attendance::where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->whereNotNull('check_in')
            ->exists();

        if (!$check) {
            $data = [
                'user_id' => $auth->id,
                'check_in' => $now,
                'date' => $now->toDateString(),
            ];

            if ($now->greaterThan($start_time)) {
                $data['status'] = AttendanceStatusEnum::INVALID;
            }

            Attendance::create($data);

            return back()->with(['message' => 'Check In thành công']);

        } else {
            return back()->with(['error' => 'Bạn đã check in ngày hôm nay.']);
        }
    }

    public function checkOut()
    {
        $auth = Auth::user();
        $now = now();
        $end_time = now()->setTime(17, 0, 0);

        // Find today's attendance record for the user
        $attendance = Attendance::where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->first();

        if ($attendance && is_null($attendance->check_out)) {

            $attendance->update([
                'check_out' => $now,
                'status' => $now->greaterThan($end_time)
                    ? AttendanceStatusEnum::INVALID
                    : AttendanceStatusEnum::VALID,
            ]);

            return back()->with(['message' => 'Check-out thành công']);

        } elseif ($attendance && !is_null($attendance->check_out)) {
            return back()->with(['error' => 'Bạn đã check out ngày hôm nay.']);
        } else {
            return back()->with(['error' => 'Bạn cần Check in trước khi Check Out.']);
        }
    }

    private function processAttendanceData($attendance, $start_time, $end_time)
    {
        $checkInTime = Carbon::parse($attendance->check_in);
        $checkOutTime = Carbon::parse($attendance->check_out);
        $lateMinutes = $start_time->diffInMinutes($checkInTime, false);


        $lateTime = $lateMinutes > 0 ? sprintf('%02d:%02d', floor($lateMinutes / 60), $lateMinutes % 60) : '00:00';


        $overtimeMinutes = $checkOutTime->greaterThan($end_time) ? $checkOutTime->diffInMinutes($end_time) : 0;
        $overtime = $overtimeMinutes > 0 ? sprintf('%02d:%02d', floor($overtimeMinutes / 60), $overtimeMinutes % 60) : '00:00';

        return [
            'id'=> $attendance->id,
            'name' => $attendance->user->name,
            'room_name' => $attendance->user->department->room_name ?? '',
            'date' => $attendance->date,
            'check_in' => $attendance->check_in,
            'check_out' => $attendance->check_out,
            'total_time' => $checkOutTime->diff($checkInTime)->format('%H:%I:%S'),
            'late' => $lateTime,
            'overtime' => $overtime,
            'status' => $attendance->status
        ];
    }

    public function edit($id)
    {
        // dd('1');
        // Lấy thông tin chấm công theo ID
        $attendance = Attendance::with('user')->findOrFail($id);

        // Trả về view kèm thông tin attendance
        return view('admin.attendance.edit', [
        'attendance' => $attendance,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after_or_equal:check_in',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Tìm bản ghi chấm công
        $attendance = Attendance::findOrFail($id);

        // Cập nhật thông tin
        $attendance->update([
            'date' => $request->input('date'),
            'check_in' => $request->input('check_in') ? Carbon::createFromFormat('H:i', $request->input('check_in'))->toDateTimeString() : null,
            'check_out' => $request->input('check_out') ? Carbon::createFromFormat('H:i', $request->input('check_out'))->toDateTimeString() : null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('dashboard')->with('message', 'Cập nhật thông tin chấm công thành công!');
    }



}