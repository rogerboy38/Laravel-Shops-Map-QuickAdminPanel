<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use Notifiable;


    protected $fillable = [
        'code', 'promo', 'time',
    ];
}
