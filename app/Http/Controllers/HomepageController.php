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

        $time = [
            'name' => $auth->name,
            'date' => $now->format('d/m/Y'),
            'day' =>  $now->locale('vi')->dayName
            'day' => $now->locale('vi')->dayName
        ];
        $start_time = now()->setTime(8, 0, 0);
        $end_time = now()->setTime(17, 0, 0);

        $data = Attendance::with(['user', 'user.department'])

        $search = $request->input('search');

        if ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                    $query->where('room_name', 'LIKE', "%{$search}%");
            });


            ->whereDate('date', $now)
            ->whereNotNull('check_in')
            ->exists();

            ->whereDate('date', $now)
            ->whereNotNull('check_out')
            ->exists();

        ]);
    }

    }

