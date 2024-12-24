<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceStatusEnum;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Payroll;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function index()
    {
        $data = Department::with('users')->get();
        $datas = [];
        $dataValues = [];
        $dataColors = [];
        $usedColors = [];


        $tuoi1830 = [];
        $tuoi3040 = [];
        $tren = [];

        $namS = [];
        $nuS = [];
        $kxdS = [];


        foreach ($data as $item) {
            $datas[] = $item->room_name;
            $dataValues[] = $item->users->count();

            do {
                $color = $this->randomColor();
            } while (in_array($color, $usedColors));

            $dataColors[] = $color;
            $usedColors[] = $color;
            $dataUsers = $item->users->groupBy('department_id');
            foreach ($dataUsers as $userGroup) {
                // Khởi tạo các biến đếm
                $tuoi30 = 0;
                $tuoi40 = 0;
                $tren40 = 0;
                $nam = 0;
                $nu = 0;
                $kxd = 0;

                foreach ($userGroup as $user) {

                    $tuoi = Carbon::parse($user->date_of_birth)->age ?? 0;
                    if ($tuoi >= 18 && $tuoi <= 30) {
                        $tuoi30++;
                    }

                    if ($tuoi > 30 && $tuoi <= 40) {
                        $tuoi40++;
                    }

                    if ($tuoi > 40) {
                        $tren40++;
                    }

                    if ($user->gender === 'nam') {
                        $nam++;
                    }
                    if ($user->gender === 'nữ') {
                        $nu++;
                    }
                    if ($user->gender === 'không xác định') {
                        $kxd++;
                    }
                }

                $tuoi1830[] = $tuoi30;
                $tuoi3040[] = $tuoi40;
                $tren[] = $tren40;

                $namS[] = $nam;
                $nuS[] = $nu;
                $kxdS[] = $kxd;
            }
        }
        $dataUsers = $this->users();
        $dataPayroll = $this->payroll();
        return view('admin.chart.index', [
            'datas' => $datas,
            'values' => $dataValues,
            'dataColors' => $dataColors,
            'tuoi1830' => $tuoi1830,
            'tuoi3040' => $tuoi3040,
            'tren' => $tren,
            'namS' => $namS,
            'nuS' =>  $nuS,
            'kxdS' => $kxdS,
            'userNames' => $dataUsers['userNames'],
            'userValids' => $dataUsers['userValids'],
            'userNoValids' => $dataUsers['userNoValids'],
            'payrolls' => $dataPayroll['payrolls'],
        ]);
    }

    private function randomColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }


    private function users()
    {
        $firstDayOfMonth = Carbon::now()->startOfMonth()->toDateString();


        $users = User::with(['attendances' => function ($query) use ($firstDayOfMonth) {
            // truy vấn theo từng phong ban nếu có request gửi lên phong ban
            // truy vấn theo tháng

        }])
            ->get();
        $userNames = [];
        $userValids = [];
        $userNoValids = [];

        foreach ($users as $user) {
            $userNames[] = $user->name;

            $userValids[] = optional($user->attendances)
                ->where('status', AttendanceStatusEnum::VALID)
                ->count() ?? 0;

            $userNoValids[] = optional($user->attendances)
                ->where('status', AttendanceStatusEnum::INVALID)
                ->count() ?? 0;
        }

        return [
            'userNames' => $userNames,
            'userValids' => $userValids,
            'userNoValids' => $userNoValids
        ];
    }

    private function payroll()
    {
        $users = User::with(['payrolls'])
            ->get();
        $userNames = [];
        $payrolls = [];


        foreach ($users as $user) {
            $userNames[] = $user->name;

            $payroll = optional($user->payrolls)
                ->where('type', 'day')
                ->first();

            $payrolls[] = $payroll->salary_received ?? 0;
        }
        // dd($payrolls);
        return [
            'userNames' => $userNames,
            'payrolls' => $payrolls,
        ];
    }
}
