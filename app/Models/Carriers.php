<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Carriers extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'carriers';
  protected $fillable = [
    'name', 'price','status','currency',
    'created_at', 'updated_at', 'deleted_at'
  ];
  protected $hidden = [
    'updated_at', 'deleted_at'
  ];
}
