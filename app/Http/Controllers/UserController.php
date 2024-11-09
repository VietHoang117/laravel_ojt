<?php

namespace App\Http\Controllers;

use App\Models\AdsContent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Role;

use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class UserController extends Controller
{
    public function index()
{
    $data = User::with('department')->paginate(4); // Paginate with 10 items per page
    return view('admin.user.index', ['data' => $data]);
}


    public function store(Request $request)
    {
        return view('admin.user.create', ['departments' =>  Department::select('id', 'room_name')->get(), 'roles' => Role::select('id', 'name')->get()]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'required',
            'phone_number'=>'required',
            'role_id' => 'required'
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
            'department_id',
            'role_id'
        ]);

        if (empty($inputs['department_id'])) {
            $inputs['department_id'] = 0;
        }

        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['position'] = md5('hoang');

        $user = User::create($inputs);

        $user->roles()->sync([$inputs['role_id']]);

        return redirect()->route('users.users');

    }

    public function edit($id)
    {
        $data = User::query()->findOrFail($id);

        return view('admin.user.update',  [ 'data'=>$data, 'departments' =>  Department::select('id', 'room_name')->get(), 'roles' => Role::select('id', 'name')->get()]);
    }

    public function saveEdit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'nullable|min:8',
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
            'department_id',
        ]);

        if ($request->filled('password')) {
            $inputs['password'] = Hash::make($inputs['password']);
        }
        if(empty($inputs['password'])) {
            unset($inputs['password']);
        };
        if(empty($inputs['department_id'])) {
            $inputs['department_id'] = 0;
        };

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

    //import-export
    public function view(){
        return view("dashboard");
    }

    public function importUsers(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::Import(new UsersImport, request()->file('file'));

        return redirect()->back();
    }

    public function exportUsers(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}