<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    public function disscount_categories()
    {
        return $this->belongsToMany('App\Models\Discounts');
    }

    public function shop_categories()
    {
        return $this->belongsToMany('App\Models\Shops');
    }

    public function shops()
    {
        return $this->hasMany('Shops');
    }
}
