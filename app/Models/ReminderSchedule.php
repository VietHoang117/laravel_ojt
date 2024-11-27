<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function scopeOwnedByUserGroup($query)
    {
        $user = Auth::user();

        if (!$user->roles()->where('is_system_role', true)->exists()) {
            return $query;
        } else {
            $query->where('user_id', $user->id);
        };
    }
}
