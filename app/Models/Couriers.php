<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Couriers extends Model
{
  use Notifiable;


  protected $table = 'couriers';
  protected $fillable = [
    'name', 'price','status','currency',
    'created_at', 'updated_at', 'deleted_at'
  ];
  protected $hidden = [
    'updated_at', 'deleted_at'
  ];
}
