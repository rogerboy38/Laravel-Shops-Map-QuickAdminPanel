<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Counter extends Model
{
    use Notifiable;

    protected $table = 'counter';

    public function generateSO($id) {
        $counter = DB::collection('counter')->raw(function($collection) use ($id){
            $collection = $collection->findOneAndUpdate([
                '_id' => $id],
                [ '$inc' => [ 'seq' => 1 ]
            ]);
            return $collection->seq;
        });
        return $counter;
    }

    public function generateClient($id) {
        $counter = DB::collection('counter')->raw(function($collection) use ($id){
            $collection = $collection->findOneAndUpdate([
                '_id' => $id],
                [ '$inc' => [ 'seq' => 1 ]
            ]);
            return $collection->seq;
        });
        return $counter;
    }
}
