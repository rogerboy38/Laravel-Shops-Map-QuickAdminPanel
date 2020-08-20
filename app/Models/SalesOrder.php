<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use Notifiable;


    protected $fillable = [
        'date','client','product','type','code','total','packaging','amount','package','realisasi','stockk','pending','balance','pendingpr','note','productattr',
    ];
}
