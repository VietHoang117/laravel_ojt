<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class DepartmentController extends Controller
{
    public function index()
    {

        $data = Department::all();

        return view('admin.department.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        return view('admin.department.create', ['departments' => Department::select('id', 'room_name')->get() ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'room_name' => 'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'parent_id',
            'room_name',


        ]);

        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['position'] = md5('hoang');

        User::create($inputs);

        return redirect()->route('departments.index');

    }

    public function edit($id)
    {
        $data = Department::query()->findOrFail($id);

        return view('admin.department.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'room_name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'parent_id',
            'room_name',

        ]);

        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['position'] = md5('hoang');
        $data = Department::query()
        ->findOrFail($id);
        $data->fill($inputs)->update();

        return redirect()->route('departments.index');







    }

    public function delete($id) {
        $data = Department::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }
}
