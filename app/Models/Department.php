<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_name',
        'status',
        'parent_id'
    ];


    public function users()
    {
        return $this->hasMany(User::class,'department_id', 'id');
    }

    public function departments() {
        return $this->hasMany(Department::class, 'id', 'parent_id');
    }
}
