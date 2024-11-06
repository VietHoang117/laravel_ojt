<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeOwnedByUserGroup($query)
    {
        $user = Auth::user();
//        return $query->where('user_id', $user->id)
//            ->whereHas('user.roles', function ($query) {
//                $query->where('is_system_role', false);
//            });
    }
}
