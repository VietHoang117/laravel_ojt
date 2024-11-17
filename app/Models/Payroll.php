<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'level_name',
        'valid_workdays',
        'invalid_workdays',
        'month',
        'salary_received',
        'processed_by',
        'processed_at',
        'updated_by',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function salarylevel() {
        return $this->belongsTo(SalaryLevel::class, 'level_name');
    }
}
