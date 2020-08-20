<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProducts extends Model
{
  Protected $fillable = ['name'];

  public function products()
  {
      return $this->belongsToMany('App\Models\Products');
  }
  public function categories()
  {
      return $this->belongsToMany('App\Models\Categories');
  }
}
