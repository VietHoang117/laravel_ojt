<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index() {


        $data = [
            [
                'id' => '123',
                'loai_de_xuat' => 'nghỉ phép dài ngày',
                'ten_de_xuat' => 'Bắc- nghỉ phép dài ngày',
                'ngay_lap' => '12/09/2024',
                'user' => 'baclv',
                'user_reviewer' => 'Admin',
                'status' => 'Đang chờ duyệt'
            ]
           
        ];
        $data = json_decode(json_encode($data));

        return view('admin.leave.index', ['data' => $data, 'status' => []]);
    }


    public function save(Request $request) {

        //validate


        // xử lý tệp

        // lưu vào db

    }


    
}
