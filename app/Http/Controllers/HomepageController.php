<?php


namespace App\Http\Controllers;


use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
        $auth = Auth::user();

        $now= now();
        $time = [
            'name' => $auth->name,
            'date' => $now->format('d/m/Y'),
            'day' =>  $now->locale('vi')->dayName
        ];
        $start_time = now()->setTime(8, 0, 0);

        $data = Attendance::with(['user', 'user.department'])
        ->where('user_id', $auth->id)
        ->orderByDesc('date')
        ->get()
        ->map(callback: function($attendance)use($start_time) {
            $checkInTime = Carbon::parse($attendance->check_in);
            $checkOutTime = Carbon::parse($attendance->check_out);

            $lateMinutes = $start_time->diffInMinutes($checkInTime);
              // Tính giờ và phút
            $hours = floor($lateMinutes / 60);
            $minutes = $lateMinutes % 60;
            $formattedLateTime = sprintf('%02d:%02d', $hours, $minutes);

            return [
                'name' => $attendance->user->name,
                'room_name' =>  $attendance->user->department->room_name ?? '',
                'date' => $attendance->date,
                'check_in' => $attendance->check_in,
                'check_out' => $attendance->check_out,
                'total_time' =>  $checkOutTime->diff($checkInTime)->format('%H:%I:%S'),
                'late' => $formattedLateTime,
                'status' => $attendance->status
            ];
        });
        

        $checkIn = Attendance::query()
            ->where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->whereNotNull('check_in')
            ->exists();

        $checkOut = Attendance::query()
            ->where('user_id', $auth->id)
            ->whereDate('date', $now)
            ->whereNotNull('check_out')
            ->exists();

            // dd($checkIn);
       
        return view('admin.dashboard', ['data' => $data, 'time' => $time, 'checkIn' => !$checkIn, 'checkOut' => !$checkOut]);
    }

    public function checkIn() {
        $auth = Auth::user();

        $now = now();
    
        $check = Attendance::query()
                ->where('user_id', $auth->id)
                ->whereDate('date', $now)
                ->whereNotNull('check_in')
                ->exists();
        
        if (!$check) {
            Attendance::create([
                'user_id' => $auth->id,
                'check_in' => $now,
                'date' => $now
            ]);
        };


        return back()->with([
            'checkIn' => !$check,
            'message' => 'Check In thành công!'
        ]);
    }

    public function checkOut() {
        $auth = Auth::user();

        $now = now();
    
        $check = Attendance::query()
                ->where('user_id', $auth->id)
                ->whereDate('date', $now)
                ->first();

        if (!$check) {
            return back()->with([
                'checkOut' =>  $check,
                'error' => 'Vui lòng check in trước khi check out!'
            ]);
        } else {
            if (empty($check->check_out)) {
                $check->fill(['check_out' => $now])->update();
            };
        }

        return back()->with([
            'checkOut' => !$check,
            'message' => 'Check In thành công!'
        ]);
    }

}