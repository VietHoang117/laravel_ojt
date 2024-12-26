<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;
use App\Enums\JustificationStatusEnum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SettingEmail;
use App\Enums\AttendanceStatusEnum;

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
            ->paginate(7);
            $status = JustificationStatusEnum::getValues();
        return view('admin.justification.index', compact(['data','status']));
    }

    public function reportJustification(Request $request, $id)
    {

        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        Justification::create([
            'attendance_id' => $id,
            'user_id' => Auth::id(),
            'reason' => $request->input('reason'),
        ]);

        return back()->with('message', 'Giải trình của bạn đã được gửi.');
    }

    // Admin duyệt giải trình
    public function confirmJustification(Request $request, $id)
    {
        $justification = Justification::with(['attendance','user'])->findOrFail($id);

        $request->validate([
            'status' => 'required|in:Chấp nhận,Từ chối',
            'response' => 'nullable|string|max:1000',
        ]);

        $justification->update([
            'status' => $request->input('status'),
            'admin_id' => Auth::id(),
            'response' => $request->input('response'),
        ]);

            // Nếu trạng thái là "Chấp nhận", cập nhật trạng thái của Attendance thành "Hợp lệ"
            if ($request->input('status') === JustificationStatusEnum::ACCEPT) {
            $justification->attendance->update(['status' => AttendanceStatusEnum::VALID,]);

            } elseif ($request->input('status') === JustificationStatusEnum::REFUSE) {
            // Nếu từ chối, không thay đổi trạng thái Attendance nhưng có thể xử lý khác nếu cần
            $justification->attendance->update(['status' => AttendanceStatusEnum::INVALID,]);
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
        $data = Justification::with(['attendance','user'])->findOrFail($id);

        if ($data) {
            $data->update([
                'response' => $request->input('response'),
                'status' => $request->input('status')
            ]);

        }

        Mail::to($data->user->email)->send(new SettingEmail([
            'name' => $data->user->name,
            'content'=>' Chúng tôi muốn thông báo yêu cầu của bạn đã được:'.$data->status,
        ]));

        return back()->with('message', 'Giải trình đã được xử lý.');
    }

    public function delete($id) {
        $data = Justification::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }

}