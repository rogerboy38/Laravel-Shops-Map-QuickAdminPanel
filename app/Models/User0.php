<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

  Protected $fillable = ['name', 'password', 'email', 'phone'];

  public function roles()
  {
      return $this->belongsToMany('App\Model\Role');
  }
  public function modulePermissions()
  {
      return $this->belongsToMany('App\Model\ModulePermissions');
  }
  public function AccessPermissions()
  {
      return $this->belongsToMany('App\Model\AccessPermissions');
  }
}
