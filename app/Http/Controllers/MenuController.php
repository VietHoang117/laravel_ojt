<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $data = Menu::all();

        return view('admin.menu.index', ['data' => $data]);
    }

    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.menu.create');
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
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
            'turn_off',
            'numerical_order'
        ]);

        if (isset($inputs['turn_off'])) {
            if ($inputs['turn_off'] === 'on') {
                $inputs['turn_off'] = true;
                $inputs['numerical_order'] = null;
            } else {
                $inputs['turn_off'] = false;
            }
        } else {
            $inputs['turn_off'] = false;
        }


        $image = $request->file('image');
        $fileName = hash('sha256', $inputs['title'] . $image->getClientOriginalName()) . '.' . $image->clientExtension();
        $inputs['image'] = $request->file('image')->storePubliclyAs('menu', $fileName, 'public');

        Menu::create($inputs);

        return redirect()->route('menu.index');

    }

    public function edit($id)
    {
        $data = Menu::query()->findOrFail($id);

        return view('admin.menu.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ],[
            'image' => 'Trường file input không được để trống!',
            'image.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'image.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $data = Menu::query()
            ->findOrFail($id);

        $inputs = $request->only([
            'title',
            'description',
            'link',
            'turn_off',
            'numerical_order'
        ]);

        if (isset($inputs['turn_off'])) {
            if ($inputs['turn_off'] === 'on') {
                $inputs['turn_off'] = true;
                $inputs['numerical_order'] = null;

                $check = Menu::where('turn_off', $inputs['turn_off'])->first();
                
                if($check) {
                    $check->fill(['turn_off' => false, 'numerical_order' => $data->numerical_order])->update();
                }

            } else {
                $inputs['turn_off'] = false;
            }
        } else {
            $inputs['turn_off'] = false;
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = hash('sha256', $inputs['title'] . $image->getClientOriginalName()) . '.' . $image->clientExtension();
            $inputs['image'] = $request->file('image')->storePubliclyAs('menu', $fileName, 'public');
            Storage::delete('storage/menu/' . $data->image);
        }
        $data->fill($inputs)->update();

        return redirect()->route('menu.index');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $data = Menu::query()->findOrFail($id);
        $data->delete();
        Storage::delete('storage/menu/' . $data->image);
        return back()->with('success', 'Xóa thành công!');
    }
}
