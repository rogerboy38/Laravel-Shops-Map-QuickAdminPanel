<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use Notifiable;
  Protected $fillable = ['id','name','email','password','remember_token','created_at','updated_at','deleted_at'];

  public function users()
  {
      return $this->belongsToMany('App\Models\User');
  }
}
