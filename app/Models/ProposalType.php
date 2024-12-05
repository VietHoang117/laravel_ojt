<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
    ];

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'proposal_type_id');
    }
}
