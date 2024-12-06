<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ProposalType;
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

    public function type()
    {
        return $this->belongsTo(ProposalType::class, 'proposal_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'user_manager_id');
    }
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'user_reviewer_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'proposal_id');
    }


    public function scopeOwnedByUserGroup($query)
    {
        $user = Auth::user();

        if ($user->roles()->where('is_system_role', true)->exists()) {
            return $query;
        } else {
            return $query->where('user_id', $user->id)
                    ->orWhere('user_reviewer_id', $user->id);
        };
    }
}
