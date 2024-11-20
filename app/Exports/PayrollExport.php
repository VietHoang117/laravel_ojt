<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payroll::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên người dùng',
            'Bậc Lương',
            'Phòng Ban',
            'Tháng',
            'Số ngày công hợp lệ',
            'Số ngày công không hợp lệ',
            'Lương nhận được'
        ];
    }
}
