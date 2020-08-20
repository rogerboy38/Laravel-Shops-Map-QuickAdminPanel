<?php
namespace	App\Models;



use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Models\AccessPermisions;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable as Notifiable;
use Eloquent; // ******** This Line *********
use DB;       // ******** This Line *********

//class Owners extends Eloquent  implements UserInterface, RemindableInterface{
	class Owners extends Authenticatable {

	protected $dates = ['deleted_at'];

    protected $table = 'owners';

	  protected $fillable = [
				'id','name', 'email', 'password', 'is_active', 'rate', 'rate_count', 'picture', 'is_approved', 'is_available', 'first_name', 'last_name'
			];

}
