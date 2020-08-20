<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Segments extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug',
        public function segment_attributes()
        {
        return $this->hasMany('App\Models\SegmentAttributes');
        }
    ];
}
