<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Utilitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UtilitiController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $data = Utilitie::orderBy('numerical_order')->get();

        return view('admin.utiliti.index', ['data' => $data]);
    }

    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.utiliti.create');
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ],[
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
            'description',
            'link',
            'numerical_order'
        ]);

        $image = $request->file('image');
        $fileName = hash('sha256', $inputs['title'] . $image->getClientOriginalName()) . '.' . $image->clientExtension();
        $inputs['image'] = $request->file('image')->storePubliclyAs('utiliti', $fileName, 'public');

        Utilitie::create($inputs);

        return redirect()->route('utiliti.index');

    }

    public function edit($id)
    {
        $data = Utilitie::query()->findOrFail($id);

        return view('admin.utiliti.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ],[
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
            'description',
            'link',
            'numerical_order'
        ]);

        $data = Utilitie::query()
            ->findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = hash('sha256', $inputs['title'] . $image->getClientOriginalName()) . '.' . $image->clientExtension();
            $inputs['image'] = $request->file('image')->storePubliclyAs('utiliti', $fileName, 'public');
            Storage::delete('storage/utiliti/' . $data->image);
        }
        $data->fill($inputs)->update();

        return redirect()->route('utiliti.index');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $data = Utilitie::query()->findOrFail($id);
        $data->delete();
        Storage::delete('storage/utiliti/' . $data->image);
        return back()->with('success', 'Xóa thành công!');
    }
}
