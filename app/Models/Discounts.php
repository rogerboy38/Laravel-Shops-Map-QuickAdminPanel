<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model

{
  Protected $fillable = ['id','code','title','description','status','currency','value','type','start_date','expired_date','categories','products','members','created_at','updated_at'];

  public function disscount_tipe_promosi()
  {
      return $this->belongsToMany('App\Models\TipePromosi');
  }
  public function disscount_categories()
  {
      return $this->belongsToMany('App\Models\Categories');
  }
  public function disscount_products()
  {
      return $this->belongsToMany('App\Models\Product');
  }
  public function disscount_members()
  {
      return $this->belongsToMany('App\Models\Member');
  }
}
