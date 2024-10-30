<?php

namespace App\Http\Controllers;

use App\Models\AdsContent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
class UserController extends Controller
{
    public function index()
    {

        $data = User::all();

        return view('admin.user.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        return view('admin.user.create', ['departments' =>  Department::select('id', 'room_name')->get()]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'required',
            'phone_number'=>'required',
            // 'position'=>'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'name',
            'email',
            'password',
            'phone_number',
            'department_id'
        ]);

        if (empty($inputs['department_id'])) {
            $inputs['department_id'] = 0;
        }
        // dd($inputs);

        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['position'] = md5('hoang');
       
        User::create($inputs);

        return redirect()->route('users.users');

    }

    public function edit($id)
    {
        $data = User::query()->findOrFail($id);

        return view('admin.user.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'nullable|min:8|confirmed',
            'phone_number'=>'required',
            // 'position'=>'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'name',
            'email',
            'password',
            'phone_number',
            'department_id'
        ]);

        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['position'] = md5('hoang');
        $data = User::query()
        ->findOrFail($id);
        $data->fill($inputs)->update();

        return redirect()->route('users.users')->with('success', 'Thông tin người dùng đã được cập nhật.');


      

        
        
    
    }

    public function delete($id) {
        $data = User::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }
}