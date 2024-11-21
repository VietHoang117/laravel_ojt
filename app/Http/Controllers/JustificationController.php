<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;
use App\Enums\JustificationStatusEnum;
use Illuminate\Support\Facades\Validator;
class JustificationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = Justification::with(['user','attendance'])
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10);
            $status = JustificationStatusEnum::getValues();
        return view('admin.justification.index', compact(['data','status']));
    }

    public function submitJustification(Request $request, $attendanceId)
    {


        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $attendance = Justification::findOrFail($attendanceId);

        if ($attendance->status !== 'Không hợp lệ') {
            return back()->with('error', 'Chỉ có thể giải trình cho các bản ghi không hợp lệ.');
        }

        Justification::create([
            'attendance_id' => $attendance->id,
            'user_id' => Auth::id(),
            'reason' => $request->input('reason'),
        ]);

        return back()->with('message', 'Giải trình của bạn đã được gửi.');
    }

    // Admin duyệt giải trình
    public function confirmJustification(Request $request, $id)
    {
        $justification = Justification::with('attendance')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:Chấp nhận,Từ chối',
            'response' => 'nullable|string|max:1000',
        ]);

        $justification->update([
            'status' => $request->input('status'),
            'admin_id' => Auth::id(),
            'response' => $request->input('response'),
        ]);

        if ($request->input('status') === 'Chấp nhận') {
            $justification->attendance->update(['status' => 'Hợp lệ']);
        }
        

        return back()->with('message', 'Giải trình đã được xử lý.');
    }

    public function submit(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'response' => 'required|string|max:1000',
            'status' => 'required'

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        $data= Justification::findOrFail($id);

        if ($data) {
            $data->update([
                'response' => $request->input('response'),
                'status' => $request->input('status')
            ]);

        };
        return back()->with('message', 'Giải trình đã được xử lý.');
    }

}
