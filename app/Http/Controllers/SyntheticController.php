<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Synthetic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SyntheticController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $data = Synthetic::all();

        return view('admin.synthetics.index', ['data' => $data]);
    }

    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.synthetics.create');
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif'
        ],[
            'logo' => 'Trường file input không được để trống!',
            'logo.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'logo.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $inputs = $request->only([
            'hottline',
            'switchboard',
            'email',
            'address',
            'operating_time',
            'link_face',
            'link_youtobe',
            'link_tiktok',
            'link_reservations'
        ]);

        $image = $request->file('logo');
        $fileName = hash('sha256', 'bacdz' . $image->getClientOriginalName()) . '.' . $image->clientExtension();
        $inputs['logo'] = $request->file('logo')->storePubliclyAs('logo', $fileName, 'public');

        Synthetic::create($inputs);

        return redirect()->route('synthetics.index');

    }

    public function edit($id)
    {
        $data = Synthetic::query()->findOrFail($id);

        return view('admin.synthetics.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ],[
            'logo' => 'Trường file input không được để trống!',
            'logo.image' => 'Tệp được chọn không phải là một tệp ảnh.',
            'logo.mimes' => 'Tệp ảnh phải có định dạng jpeg, png, jpg hoặc gif.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $inputs = $request->only([
            'hottline',
            'switchboard',
            'email',
            'address',
            'operating_time',
            'link_face',
            'link_youtobe',
            'link_tiktok',
            'link_reservations'
        ]);

        $data = Synthetic::query()
            ->findOrFail($id);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = hash('sha256', 'bacdz' . $image->getClientOriginalName()) . '.' . $image->clientExtension();
            $inputs['logo'] = $request->file('logo')->storePubliclyAs('logo', $fileName, 'public');
            Storage::delete('storage/logo/' . $data->logo);
        }
        $data->fill($inputs)->update();

        return redirect()->route('synthetics.index');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $data = Synthetic::query()->findOrFail($id);
        $data->delete();
        Storage::delete('storage/synthetics/' . $data->image);
        return back()->with('success', 'Xóa thành công!');
    }
}
