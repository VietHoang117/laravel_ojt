<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_type_id',
        'proposal_name',
        'content',
        'day_off',
        'from_date',
        'to_date',
        'department_id',
        'user_id',
        'user_manager_id',
        'user_reviewer_id',
        'status'
    ];


    // liên kết đến bảng user
    
}
