<?php


namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\Collection;
use App\Models\GeneralDescription;
use App\Models\Menu;
use App\Models\Synthetic;
use App\Models\Upcoming;
use App\Models\Utilitie;

class HomepageController extends Controller
{
    public function index()
    {

        $banners = Banner::all();

        $sapiens = Upcoming::orderBy('id')->get();

        $genera = GeneralDescription::first();

        $menus = Menu::all()
            ->sortByDesc('turn_off')
            ->sortBy('numerical_order');
        //Tiện ích

        $utilities = Utilitie::all()
            ->sortByDesc('numerical_order');

        // Bộ sưu tập
        $collects = Collection::all()
            ->sortBy('location');

        // Thông tin chung
        $synthetics = Synthetic::first();

        return view('client.index',
            [
                'banners' => $banners,
                'sapiens' => $sapiens,
                'genera' => $genera,
                'menus' => $menus,
                'utilities' => $utilities,
                'collects' => $collects,
                'synthetics' => $synthetics
            ]);
    }
}
