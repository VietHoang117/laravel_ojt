<?php

namespace App\Http\Controllers;

use App\Models\SalaryLevel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class SalaryLevelController extends Controller
{
    // Hiển thị danh sách các bậc lương
    public function index()
    {
        $data = SalaryLevel::all();
        return view('admin.salary-level.index', ['data' => $data]);


    }

    // Hiển thị form tạo bậc lương mới
    public function create()
    {
        $users = User::select('id', 'name')->whereHas('roles',function($query) {
            return $query->where('is_system_role', '!=', true);
        })->get();
        return view('admin.salary-level.create', ['users' => $users]);
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
            'level_name' => 'required|string|max:255',
            'daily_rate' => 'required',
            'monthly_rate' => 'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'user_id',
            'level_name',
            'daily_rate',
            'monthly_rate'
        ]);

        SalaryLevel::create($inputs);
        return redirect()->route('salarylevels.index')->with('success', 'Bậc lương đã được thêm mới thành công.');
    }


    // Hiển thị form chỉnh sửa bậc lương
    public function edit($id)
    {
        $data = SalaryLevel::query()->findOrFail($id);
        return view('admin.salary-level.update', compact('data'));
    }

    // Cập nhật bậc lương
    public function saveEdit(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'level_name' => 'required|string|max:255',
            'daily_rate' => 'required',
            'monthly_rate' => 'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $inputs = $request->only([
            'level_name',
            'daily_rate',
            'monthly_rate'
        ]);

        $data = SalaryLevel::query()->findOrFail($id);

        $data->fill($inputs)->update();

        // Redirect to payrolls index page after successful update
        return redirect()->route('salarylevels.index');
    }

    // Xóa bậc lương
    public function delete($id) {
        $data = SalaryLevel::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }

    public function getSalaryLevel($id)
{
    $data = SalaryLevel::find($id);

    if (!$data) {
        return response()->json(['error' => 'Bậc lương không tồn tại'], 404);
    }

    return response()->json([
        'daily_rate' => $data->daily_rate,
        'monthly_rate' => $data->monthly_rate
    ]);
}

}
