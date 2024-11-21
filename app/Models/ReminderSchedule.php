<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'reminder_time',
        'is_sent',
    ];

    protected $casts = [
        'reminder_time' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
