<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfigurationEmail;
use App\Models\Attendance;
use App\Enums\AttendanceStatusEnum;


class ConfigurationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id],
            [
                'check_in' => '08:00', // Giá trị mặc định nếu chưa có
                'check_out' => '17:00' // Giá trị mặc định nếu chưa có
            ]
        );
        
        return view('configuration.index', compact('attendance'));
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