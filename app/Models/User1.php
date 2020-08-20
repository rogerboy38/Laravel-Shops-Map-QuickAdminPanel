<?php

namespace App\Models;



use App\Models\SalesOrder;
use App\Models\AccessPermisions;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable

{


	use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	protected $dates = ['deleted_at'];

	public function modPermissions(){
	    $module_permisssion = Permission::where('type','module-menu')->where('parent',null)->get();

	    for($i=0; $i < $module_permisssion->count(); $i++){
		    $module_permisssion[$i]->child = Permission::where('parent',$module_permisssion[$i]->id)->get();
        }
        return $module_permisssion;
	}
	public function accPermissions(){
		$access_permisssion = Permission::where('type','access')->get();
		return $access_permisssion;
	}

	public function hasAcc($slug){
        $status = false;

        if(Auth::user()->email == env('ROOT_USERNAME')){
            $status = true;
						dd($module_permisssion);
        }else{
            $key = array_search($slug, array_column(Auth::user()->accessPermissions, 'slug'));
						dd($key);
            if($key > -1 ){ $status = true; }
        }
		return $status;
	}

    public function countPOPending(){
        return SalesOrder::where('status','order')->count();
    }
}
