<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'slug',
    ];
}
