<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Day extends Model
{
    use Translatable;
    protected $table = 'days';

    protected $fillable = [
        'name'
    ];
}
