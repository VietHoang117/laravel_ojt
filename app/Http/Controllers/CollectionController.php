<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $data = Collection::orderBy('location')->get();

        return view('admin.department.index', ['data' => $data]);
    }

    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.department.create');
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'location' => 'required'
        ],[
            'location' => 'Trường số thứ tự không được để trống!',
            'image' => 'Trường file input không được để trống!',
            'image.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'image.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $inputs = $request->only([
            'description',
            'location',
            'link'
        ]);

        $image = $request->file('image');
        $fileName = hash('sha256', 'baclv' . $image->getClientOriginalName()) . '.' . $image->clientExtension();
        $inputs['image'] = $request->file('image')->storePubliclyAs('department', $fileName, 'public');

        Collection::create($inputs);

        return redirect()->route('department.index');

    }

    public function edit($id)
    {
        $data = Collection::query()->findOrFail($id);

        return view('admin.department.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'location' => 'required'
        ],[
            'location' => 'Trường số thứ tự không được để trống!',
            'image' => 'Trường file input không được để trống!',
            'image.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'image.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $inputs = $request->only([
            'description',
            'location',
            'link'
        ]);

        $data = Collection::query()
            ->findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = hash('sha256', 'baclv' . $image->getClientOriginalName()) . '.' . $image->clientExtension();
            $inputs['image'] = $request->file('image')->storePubliclyAs('department', $fileName, 'public');
            Storage::delete('storage/department/' . $data->image);
        }
        $data->fill($inputs)->update();

        return redirect()->route('department.index');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $data = Collection::query()->findOrFail($id);
        $data->delete();
        Storage::delete('storage/department/' . $data->image);
        return back()->with('success', 'Xóa thành công!');
    }
}
