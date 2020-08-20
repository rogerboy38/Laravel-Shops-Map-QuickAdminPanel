<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use DB;

class CodeMembers extends Model
{
    use Notifiable;

    protected $table = 'codemembers';

    public function generateSO($id) {
        $codemember = DB::collection('codemembers')->raw(function($collection) use ($id){
            $collection = $collection->findOneAndUpdate([
                '_id' => $id],
                [ '$inc' => [ 'seq' => 1 ]
            ]);
            return $collection->seq;
        });
        return $codemember;
    }
}
