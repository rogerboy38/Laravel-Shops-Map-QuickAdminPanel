<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    use Notifiable;


    protected $fillable = [
        'code','name','type','500','1','5','25','currency',
    ];
    public function disscount_products()
    {
        return $this->belongsToMany('App\Models\Discounts');
    }
    public function shop_products()
    {
        return $this->belongsToMany('App\Models\Shops');
    }
    public function sprite_products()
    {
        return $this->belongsToMany('App\Models\Sprites');
    }
}
