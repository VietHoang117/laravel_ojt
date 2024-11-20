<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryLevel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'level_name',
        'daily_rate',
        'monthly_rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}