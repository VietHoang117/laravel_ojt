<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class ChartController extends Controller
{
    public function index()
    {
        $data = Department::with('departments')->paginate(6);

        

        return view('admin.chart.index', compact('data'));
    }
}
