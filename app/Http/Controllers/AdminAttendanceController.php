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

    public function confirmAttendance(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        if ($attendance->status === 'Không hợp lệ' && $attendance->justification_reason) {
            $isApproved = $request->input('approve') === 'true';

            $attendance->update([
                'status' => $isApproved ? 'Hợp lệ' : 'Không hợp lệ',
                'is_confirmed' => $isApproved,
                'confirmed_by' => Auth::id(),
                'confirmed_at' => now(),
            ]);

            $message = $isApproved 
                ? 'Ngày công đã được xác nhận là Hợp lệ.' 
                : 'Ngày công đã bị từ chối xác nhận. Chỉ tính 50% lương.';

            return back()->with(['message' => $message]);
        }

        return back()->with(['error' => 'Không thể xử lý bản ghi này.']);
    }
}
