<?php

namespace App\Http\Controllers;

use App\Models\GeneralDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralDescriptionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $data = GeneralDescription::all();

        return view('admin.general.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        return view('admin.general.create');
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $inputs = $request->only([
            'title',
            'description',
        ]);

        GeneralDescription::create($inputs);

        return redirect()->route('general.index');

    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = GeneralDescription::query()->findOrFail($id);

        return view('admin.general.update', ['data' => $data]);
    }

    public function saveEdit(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $inputs = $request->only([
            'title',
            'description',
        ]);
        $data = GeneralDescription::query()
            ->findOrFail($id);

        $data->fill($inputs)->update();

        return redirect()->route('general.index');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $data = GeneralDescription::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }
}
