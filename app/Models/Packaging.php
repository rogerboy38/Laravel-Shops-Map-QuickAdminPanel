<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
  use Notifiable;


  protected $table = 'packagings';
  protected $fillable = [
    'code', 'name', 'description', 'price', 'currency', 'created_by', 'updated_by',
    'deleted_by', 'created_at', 'updated_at', 'deleted_at'
  ];
  protected $hidden = [
    'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
  ];
}
