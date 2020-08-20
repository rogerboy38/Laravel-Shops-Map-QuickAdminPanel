<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use Notifiable;


    protected $fillable = [
        'id_customer','name_customer','name','total',
    ];
}
