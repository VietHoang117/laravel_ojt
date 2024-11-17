<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            ->paginate(4)
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

        // Check if user already checked in today
        $check = Attendance::where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->whereNotNull('check_in')
            ->exists();

        if (!$check) {
            // Create a new attendance record with check-in time
            Attendance::create([
                'user_id' => $auth->id,
                'check_in' => $now,
                'date' => $now->toDateString(),
            ]);

            return back()->with([
                'message' => 'Check In thành công'
            ]);
        } else {
            return back()->with([
                'error' => 'Bạn đã check in ngày hôm nay.'
            ]);
        }
    }

    public function checkOut()
    {
        $auth = Auth::user();
        $now = now();

        // Find today's attendance record for the user
        $attendance = Attendance::where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->first();



        // Check if a check-in exists and check-out has not been recorded yet
        if ($attendance && is_null($attendance->check_out)) {
            // Update the attendance record with check-out time
            // tính lấy check out - checkin nếu số giờ nhỏ hơn 6 thì update status không có hop le

            $attendance->update([
                'check_out' => $now,
            ]);

            return back()->with([
                'message' => 'Check-out thành công'
            ]);
        } elseif ($attendance && !is_null($attendance->check_out)) {
            return back()->with([
                'error' => 'Bạn đã check out ngày hôm nay.'
            ]);
        } else {
            return back()->with([
                'error' => 'Bạn cần Check in trước khi Check Out.'
            ]);
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
}
