<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Enums\DepartmentStatusEnum;


class DepartmentController extends Controller
{
    public function index()
    {

        $data = Department::with('departments')->paginate(6);

        return view('admin.department.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        return view('admin.department.create', ['departments' => Department::select('id', 'room_name')->get() ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'parent_id',
            'room_name',
            'status'
        ]);

        $inputs['status'] = $request->has('status') ? DepartmentStatusEnum::ACTIVATED : DepartmentStatusEnum::DEACTIVATED;

        Department::create($inputs);

        return redirect()->route('departments.index');

    }

    public function edit($id)
    {
        $data = Department::query()->findOrFail($id);

        return view('admin.department.update', ['data' => $data, 'departments' => Department::select('id', 'room_name')->get()]);
    }

    public function saveEdit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'room_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'parent_id',
            'room_name',
            'status'
        ]);

        $inputs['status'] = $request->has('status') ? DepartmentStatusEnum::ACTIVATED : DepartmentStatusEnum::DEACTIVATED;
        
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