<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $attendances = Attendance::with(['user', 'user.department'])
            ->where('status', 'Không hợp lệ')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })->orWhereHas('user.department', function ($q) use ($search) {
                    $q->where('room_name', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.attendance.index', compact('attendances'));
    }

    

    
    
}
