<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Utilitie extends Model {
    protected $fillable = [
        'title',
        'image',
        'description',
        'link',
        'numerical_order',
    ];
}
