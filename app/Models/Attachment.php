<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'file_name',
        'file_path'
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, foreignKey: 'proposal_id');
    }

}
