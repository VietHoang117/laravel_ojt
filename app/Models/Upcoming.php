<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Upcoming extends Model {
    protected $fillable = [
        'title',
        'big_title',
        'great_description',
        'image',
        'location',
        'time'
    ];
}
