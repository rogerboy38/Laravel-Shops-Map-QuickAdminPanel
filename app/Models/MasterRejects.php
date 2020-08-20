<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class MasterRejects extends Model
{
    use Notifiable;


    protected $table = 'master_rejects';
    protected $fillable = [
        'name','type','created_by', 'updated_by',
        'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'created_at'
    ];
    protected $hidden = [
        'created_by', 'updated_by', 'deleted_by', 'updated_at', 'deleted_at'
    ];
}
