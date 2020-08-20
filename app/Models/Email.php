<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use Notifiable;


    protected $fillable = [
        'adminId','memberEmail','subject','content','comment',
    ];
}
