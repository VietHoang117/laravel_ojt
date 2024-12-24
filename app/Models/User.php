<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'position',
        'department_id',
        'date_of_birth',
        'gender'
    ];
  
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasPermission($permission)
    {
        if ($this->roles()->where('is_system_role', true)->exists()) {
            return true;
        }

        return $this->roles()->whereHas('permissions', callback: function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }

    public function payrolls() {
        return $this->hasMany(Payroll::class );
    }

    public function attendances() {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    public function salaryLevel() {
        return $this->hasOne(SalaryLevel::class, 'user_id')->latest('id');
    }

    public function proposals() {
        return $this->hasMany(Proposal::class, 'user_id');
    }

    

}
