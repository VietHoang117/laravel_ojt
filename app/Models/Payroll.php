<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'valid_workdays',
        'invalid_workdays',
        'month',
        'salary_received',
        'type',
        'processed_by'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function salarylevel() {
        return $this->belongsTo(SalaryLevel::class, 'user_id', 'user_id');
    }
}
