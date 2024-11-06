<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Synthetic extends Model {
    protected $fillable = [
        'hottline',
        'switchboard',
        'email',
        'address',
        'logo',
        'operating_time',
        'link_face',
        'link_youtobe',
        'link_tiktok',
        'link_reservations'
    ];
}
