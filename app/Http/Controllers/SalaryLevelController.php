<?php

namespace App\Http\Controllers;

use App\Models\SalaryLevel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class SalaryLevelController extends Controller
{
    // Hiển thị danh sách các bậc lương
    public function index()
    {
        $salaryLevels = SalaryLevel::select('level_name')->distinct()->get();

        $users = User::whereIn('id', SalaryLevel::pluck('user_id'))->get();

        $users = User::all();

        $salaryLevels->each(function ($salary) use ($users) {
            $userIdsInLevel = SalaryLevel::where('level_name', $salary->level_name)->pluck('user_id');
            
            $salary->users = $users->whereIn('id', $userIdsInLevel);
            
        });
        return view('admin.salary-level.index', ['salaryLevels' => $salaryLevels]);


    }

    // Hiển thị form tạo bậc lương mới
    public function create()
    {
        $users = User::select('id', 'name')->whereHas('roles', function ($query) {
            return $query->where('is_system_role', '!=', true);
        })
            ->get();
        return view('admin.salary-level.create', ['users' => $users]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'level_name' => 'required|string|max:255|unique:salary_levels,level_name',
            'daily_rate' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        $selectedUsers = $request->input('user_id'); // Mảng user_id
        $levelName = $request->input('level_name');
        $dailyRate = $request->input('daily_rate');

        foreach ($selectedUsers as $userId) {
            SalaryLevel::updateOrCreate([
                'user_id' => $userId,
            ], [
                'level_name' => $levelName,
                'daily_rate' => $dailyRate,
            ]);
        }

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
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $inputs = $request->only([
            'level_name',
            'daily_rate'
        ]);

        $data = SalaryLevel::query()->findOrFail($id);

        $data->fill($inputs)->update();

        return redirect()->route('salarylevels.index');
    }

    public function delete($user_id)
    {
        $ids = SalaryLevel::where('user_id', $user_id)->first();

        $ids->delete();

        return redirect()->route('salarylevels.index')->with('success', 'Bậc lương đã được xóa thành công.');
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
