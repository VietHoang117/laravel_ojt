<?php

namespace App\Http\Controllers;

use App\Models\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SapDienRaController extends Controller
{
    public function index()
    {

        $data = Upcoming::all();

        return view('admin.upcoming.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        return view('admin.upcoming.create');
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
            'big_title'=> 'required',
        ],[
            'title' => 'Trường tên không được để trống!',
            'big_title.required'=> 'Trường tiêu đề chính không được để trống!',
            'image' => 'Trường file input không được để trống!',
            'image.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'image.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $inputs = $request->only([
            'title',
            'big_title',
            'great_description',
            'location',
            'time'
        ]);
        $image = $request->file('image');
        $fileName = hash('sha256', $inputs['title'] . $image->getClientOriginalName()) . '.' . $image->clientExtension();
        $inputs['image'] = $request->file('image')->storePubliclyAs('upcoming', $fileName, 'public');

        Upcoming::create($inputs);

        return redirect()->route('upcoming.index');

    }

    public function edit($id)
    {
        $data = Upcoming::query()->findOrFail($id);

        return view('admin.upcoming.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
            'big_title'=> 'required',
        ],[
            'title' => 'Trường tên không được để trống!',
            'big_title.required'=> 'Trường tiêu đề chính không được để trống!',
            'image' => 'Trường file input không được để trống!',
            'image.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'image.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->only([
            'title',
            'big_title',
            'great_description',
            'location',
            'time'
        ]);
        $data = Upcoming::query()
            ->findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = hash('sha256', $inputs['title'] . $image->getClientOriginalName()) . '.' . $image->clientExtension();
            $inputs['image'] = $request->file('image')->storePubliclyAs('upcoming', $fileName, 'public');
            Storage::delete('storage/upcoming/' . $data->image);
        }

        $data->fill($inputs)->update();

        return redirect()->route('upcoming.index');
    }

    public function delete($id) {
        $data = Upcoming::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }
}
