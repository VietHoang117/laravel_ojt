<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfigurationEmail;
use App\Models\Attendance;
use App\Models\ReminderSchedule;


class ConfigurationController extends Controller
{
    public function index()
    {
        $data = ReminderSchedule::query()
                ->with('user')
                ->OwnedByUserGroup()
                ->paginate(10);
        
        return view('admin.reminder-schedule.index', compact('data'));
    }

    public function store(Request $request)
    {
        $attendance = Attendance::select('user_id')->get();
        return view('configuration.create', ['user_id' => $attendance]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i',
        ]);

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Cập nhật hoặc tạo mới thông tin giờ check-in/check-out
        $attendance = Attendance::updateOrCreate(
            ['user_id' => $user->id],
            [
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
            ]
        );

        return redirect()->route('configurations.index')
            ->with('success', 'Cài đặt giờ nhắc nhở đã được lưu thành công.');
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

        Mail::to($data->user->email)->send(new ConfigurationEmail([
            'name' => $data->user->name,
            'content'=>'Yêu cầu của bạn đã được:'.$data->status,
        ]));

        return back()->with('message', 'Giải trình đã được xử lý.');
    }
}