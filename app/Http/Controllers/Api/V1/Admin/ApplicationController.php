<?php
namespace App\Http\Controllers\Api\V1\Admin;

use URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Models\State as States;
use App\users as users;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\View;
use App\filters;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Shop;
use App\Day;
use Carbon\Carbon;
use App\Models\CategoryShops;
use Response;
use App\Http\Resources\Admin\ShopResource;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Resources\Admin\CategoryShopResource;
use Gate;

class ApplicationController extends BaseController {

    private function _braintreeConfigure() {

      /*  Braintree_Configuration::environment(Config::get('app.braintree_environment'));
        Braintree_Configuration::merchantId(Config::get('app.braintree_merchant_id'));
        Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
        Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));*/
    }
       public function apiGetCategory(){
      //abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      return new CategoryResource(Category::all());

    }
    public function apiGetShop($request){

      //abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     $media_url = Config::get('app.asset_img');
     $shops_array = array();
     $photos_array = array();
     $category_array = array();
     $days_array = array();
     $shops = Shop::get()->load('categories', 'days')->where('id' ,$request)->all();

     foreach ($shops as $shop) {
         $data = array();
         $data['id'] = $shop->id;
         $data['isOpen']      = $shop->working_hours->isOpen();
         $shopId = $shop->id;
         $data['name'] = $shop->name;
         $data['description'] = $shop->description;
         $data['address'] = $shop->address;
         $data['latitude'] = $shop->latitude;
         $data['longitude'] = $shop->longitude;
         $data['active'] = $shop->active;
         $data['country_code'] = $shop->country_code;
         $data['phone'] = $shop->phone;
         array_push($shops_array, $data);
         foreach ($shop->photos as $photo) {
           $data1 = array();
           $data1['id'] = $photo->id;
           $data1['url'] = $photo->url;
           $thumbnail  = $media_url."/".$photo->order_column."/conversions/".substr($photo->file_name, 0,strlen($photo->file_name)-4 )."-thumb.".substr($photo->file_name, 3 ,strlen($photo->file_name) );
           $data1['thumbnail']  =$thumbnail;
           array_push($photos_array, $data1);
         }
         foreach ($shop->categories as $category) {
           $data2 = array();
           $data2['id'] = $category->id;
           $data2['name'] = $category->name;
           array_push($category_array, $data2);
         }
         $query2 = DB::table('day_shop')
                             ->select('day_shop.day_id as day_id',  'day_shop.from_hours as from_hours', 'day_shop.from_minutes as from_minutes', 'day_shop.to_hours as to_hours', 'day_shop.to_minutes as to_minutes')
                             ->leftjoin('shops' , 'shops.id' , '=','day_shop.shop_id')
                             ->where('shops.id','=', $shopId)
                             ->get();
         foreach ($query2 as $day) {
           $data3 = array();

           $data3['day_id'] = $day->day_id;
           $data3['from_hours'] = $day->from_hours;
           $data3['from_minutes'] = $day->from_minutes;
           $data3['to_hours'] = $day->to_hours;
           $data3['to_minutes'] = $day->to_minutes;

           array_push($days_array, $data3);
         }
       //array_push($shops_array, $photos_array, $category_array);
       }
        $response_array = array();
        $response_array['success'] = true;
        $response_array['data'] = $shops_array;
        $response_array['photos'] = $photos_array;
        $response_array['categories']  = $category_array;
        $response_array['days']  = $days_array;
        $response_code = 200;
        $response = Response::json($response_array, $response_code);
        return $response;
        //return new ShopResource(json_encode($shop));

    }

    public function apiGetShopsInCategory($request)
    {
      $media_url = Config::get('app.asset_img');
      $shop_array = array();
      $response_array1 = array();
      $categoryShops = CategoryShops::select('shop_id')->where('category_id',$request)->get();
      foreach ($categoryShops as $key1 => $categoryShop1) {
        $categoryShop2 =$categoryShop1->shop_id;
        $shop = Shop::get('id', 'name', 'address', 'latitude', 'longitude', 'active')->load('categories')->where('id' ,$categoryShop2)->all();
          foreach ($shop as $key2 => $shop2) {
            $query = DB::table('day_shop')
                            ->select('shops.id as id', 'category_shop.category_id as category_id', 'shops.name as name', 'shops.address as address', 'shops.latitude as latitude', 'shops.longitude as longitude','shops.active as active', 'day_shop.day_id as day_id', 'media.file_name', 'media.order_column as order_column')
                            ->leftjoin('shops' , 'shops.id' , '=','day_shop.shop_id')
                            ->leftjoin('category_shop' , 'category_shop.shop_id', '=', 'shops.id')
                            ->leftjoin('media' , 'media.model_id', '=', 'shops.id')
                            ->where('shops.id','=', $categoryShop2)
                            ->where('category_id' , '=' , $request)

                            ->get()
                            ->first();

                            //->where('day_shop.day_id','=', $dayOfWeek)
          if ($query) {
          $query=array($query);
          //return($query);
          $category_array=array();

            foreach ($query as $key3 => $shop3) {
              unset($response_array1);

              foreach ($query as $key3 => $shop3) {
                $thumbnail = $media_url.$shop3->order_column."/conversions/".substr($shop3->file_name, 0,strlen($shop3->file_name)-4 )."-thumb.".substr($shop3->file_name, 3 ,strlen($shop3->file_name) );


                    $data1 = array();
                    $data1['isOpen']      = $shop2->working_hours->isOpen();
                    $data1['id']          = $categoryShop2;
                    $data1['name']        = $shop3->name;
                    $data1['address']     = $shop3->address;
                    $data1['latitude']    = $shop3->latitude;
                    $data1['longitude']   = $shop3->longitude;
                    $data1['active']      = $shop3->active;
                    $data1['thumbnail']   = $thumbnail;
                    $data1['categories']  = $category_array;

                    $query2 = DB::table('day_shop')
                                        ->select('category_shop.category_id', 'categories.name' )
                                        ->leftjoin('shops' , 'shops.id' , '=','day_shop.shop_id')
                                        ->leftjoin('media' , 'media.model_id', '=', 'shops.id')
                                        ->leftjoin('category_shop', 'category_shop.shop_id','=', 'shops.id')
                                        ->leftjoin('categories' , 'category_shop.category_id' , '=','categories.id')
                                        ->where('shops.id','=', $categoryShop2)
                                        ->groupBy('category_shop.category_id')
                                        ->get();
                    foreach ($query2 as $key4 => $category) {
                        $data2 = array();
                        $data2['id_category'] = $category->category_id;
                        $data2['name'] = $category->name;


                      array_push($category_array,$data2);

                     }
                     $data1['categories'] = $category_array;

                     array_push($shop_array, $data1);


              }
            }
          }
          $response_array1 =   array("data" => $shop_array);
          //$response_array1 = $data3;
        }
          //array_push($response_array1,$data3);

      }
      //return($response_array1);
      $response_code = 200;

      $response = Response::json( $response_array1, $response_code);

      return $response;
    }

    public function apiShopShow($request){
        //abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $shop = Shop::get()->load('categories', 'days')->where('id' ,$request)->all();
        return new ShopResource($shop);


    }

    public function apiGetShopsInCategory3($request){
      $media_url = Config::get('app.asset_img');
      $shops_array = array();
      $photos_array = array();
      $response_array1 = array();
      $response_array = array();
      $category_array = array();
      $categoryShops = CategoryShops::select('shop_id')->where('category_id',$request)->get();
      foreach ($categoryShops as $key1 => $categoryShop1) {
        $response_array = array();
        $categoryShop2 =$categoryShop1->shop_id;
        $shops = Shop::get('id', 'name', 'address', 'latitude', 'longitude', 'active')->load('categories')->where('id' ,$categoryShop2)->all();
        foreach ($shops as $shop) {
           unset($response_array1);

            $data = array();
            $data['id'] = $shop->id;
            $data['name'] = $shop->name;
            $data['description'] = $shop->description;
            $data['address'] = $shop->address;
            $data['latitude'] = $shop->latitude;
            $data['longitude'] = $shop->longitude;
            $data['active'] = $shop->active;
            $data['country_code'] = $shop->country_code;
            $data['phone'] = $shop->phone;


            foreach ($shop->photos as $photo) {
              $data1 = array();
              $data1['id'] = $photo->id;
              $data1['url'] = $photo->url;
              $thumbnail  = $media_url."/".$photo->order_column."/conversions/".substr($photo->file_name, 0,strlen($photo->file_name)-4 )."-thumb.".substr($photo->file_name, 3 ,strlen($photo->file_name) );
              $data1['thumbnail']  =$thumbnail;
              array_push($photos_array, $data1);
            }

            foreach ($shop->categories as $category) {
              $data2 = array();
              $data2['id'] = $category->id;
              $data2['name'] = $category->name;
              array_push($category_array, $data2);
            }
              $data['photos'] = $photos_array;
              $data['categories'] = $category_array;

            array_push($shops_array, $data);

            ;
          }
          //return($data3);
          $response_array1 =   array("data" => $shops_array);


      }
      //return($data3);


      $response_code = 200;
      $response = Response::json($response_array1, $response_code);
      return $response;
    }
    public function apiGetShopsInCategory2($request)

    {
      //abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      $abierto = false;
      $media_url = Config::get('app.asset_url');
      $now = Carbon::now()->format('l');
      $dayOfWeek = intval(trans('voyager.dayOfWeek.'.$now));
      //$data = array();
      $categoryShops = CategoryShops::select('shop_id')->where('category_id',$request)->get();
      foreach ($categoryShops as $key1 => $categoryShop1) {
        $categoryShop2 =$categoryShop1->shop_id;
        $shops = Shop::select('id', 'name', 'address', 'latitude', 'longitude', 'active')->where('id',$categoryShop2)->get();
        foreach ($shops as $key2 => $shop2) {
            if ($shop2->id = $categoryShop2) {
              echo ($shop2->id);
              }
          }

        }

    }

    public function pages() {
        $informations = Information::all();
        $informations_array = array();
        foreach ($informations as $information) {
            $data = array();
            $data['id'] = $information->id;
            $data['title'] = $information->title;
            $data['content'] = $information->content;
            $data['icon'] = $information->icon;
            array_push($informations_array, $data);
        }
        $response_array = array();
        $response_array['success'] = true;
        $response_array['informations'] = $informations_array;
        $response_code = 200;
        $response = Response::json($response_array, $response_code);
        return $response;
    }

    public function get_page() {
        $id = Request::segment(3);
        $information = Information::find($id);
        $response_array = array();
        if ($information) {
            $response_array['success'] = true;
            $response_array['title'] = $information->title;
            $response_array['content'] = $information->content;
            $response_array['icon'] = $information->icon;
        } else {
            $response_array['success'] = false;
        }
        $response_code = 200;
        $response = Response::json($response_array, $response_code);
        return $response;
    }

    public function types() {
        $types = ProviderTypes::where('is_visible', '=', 1)->get();
        /* $setbase_price = Settings::where('key', 'base_price')->first();
          $base_price = $setbase_price->value;
          $setdistance_price = Settings::where('key', 'price_per_unit_distance')->first();
          $distance_price = $setdistance_price->value;
          $settime_price = Settings::where('key', 'price_per_unit_time')->first();
          $time_price = $settime_price->value; */
        $type_array = array();
        $settunit = Settings::where('key', 'default_distance_unit')->first();
        $unit = $settunit->value;
        if ($unit == 0) {
            $unit_set = 'kms';
        } elseif ($unit == 1) {
            $unit_set = 'miles';
        }
        /* $currency_selected = Keywords::find(5); */
        foreach ($types as $type) {
            $data = array();
            $data['id'] = $type->id;
            $data['name'] = $type->name;
            $data['min_fare'] = $type->base_price;
            $data['max_size'] = $type->max_size;
            $data['icon'] = $type->icon;
            $data['is_default'] = $type->is_default;
            $data['price_per_unit_time'] = ($type->price_per_unit_time);
            $data['price_per_unit_distance'] = ($type->price_per_unit_distance);
            $data['base_price'] = ($type->base_price);
            $data['base_distance'] = ($type->base_distance);
            /* $data['currency'] = $currency_selected->keyword; */
            $data['currency'] = Config::get('app.generic_keywords.Currency');
            $data['unit'] = $unit_set;
            array_push($type_array, $data);
        }
        $response_array = array();
        $response_array['success'] = true;
        $response_array['types'] = $type_array;
        $response_code = 200;
        $response = Response::json($response_array, $response_code);
        return $response;
    }

    public function forgot_password() {
        $type = Input::get('type');
        $email = Input::get('email');
        if ($type == 1) {
            // Walker
            $walker_data = \App\Walkers::where('email', $email)->first();
            if ($walker_data) {
                $walker = \App\Walkers::find($walker_data->id);
                $new_password = time();
                $new_password .= rand();
                $new_password = sha1($new_password);
                $new_password = substr($new_password, 0, 8);
                $walker->password = Hash::make($new_password);
                $walker->save();

                /* $subject = "Your New Password";
                  $email_data = array();
                  $email_data['password'] = $new_password;
                  send_email($walker->id, 'walker', $email_data, $subject, 'forgotpassword'); */
                $settings = Settings::where('key', 'admin_email_address')->first();
                $admin_email = $settings->value;
                $login_url = web_url() . "/usuarios/entrar";
                $pattern = array('name' => $walker->first_name . " " . $walker->last_name, 'admin_eamil' => $admin_email, 'new_password' => $new_password, 'login_url' => $login_url);
                $subject = "Tu nueva contrase単a";
                email_notification($walker->id, 'walker', $pattern, $subject, 'forgot_password', "imp");

                $response_array = array();
                $response_array['success'] = true;
                $response_code = 200;
                $response = Response::json($response_array, $response_code);
                return $response;
            } else {
                $response_array = array('success' => false, 'error' => 'This Email is not Registered', 'error_code' => 425);
                $response_code = 200;
                $response = Response::json($response_array, $response_code);
                return $response;
            }
        } else {
            $owner_data = Owner::where('email', $email)->first();
            if ($owner_data) {

                $owner = Owner::find($owner_data->id);
                $new_password = time();
                $new_password .= rand();
                $new_password = sha1($new_password);
                $new_password = substr($new_password, 0, 8);
                $owner->password = Hash::make($new_password);
                $owner->save();

                /* $subject = "Your New Password";
                  $email_data = array();
                  $email_data['password'] = $new_password;
                  send_email($owner->id, 'owner', $email_data, $subject, 'forgotpassword'); */
                $settings = Settings::where('key', 'admin_email_address')->first();
                $admin_email = $settings->value;
                $login_url = web_url() . "/usuarios/entrar";
                $pattern = array('name' => $owner->first_name . " " . $owner->last_name, 'admin_eamil' => $admin_email, 'new_password' => $new_password, 'login_url' => $login_url);
                $subject = "Tu nueva contrase単a";
                email_notification($owner->id, 'owner', $pattern, $subject, 'forgot_password', "imp");


                $response_array = array();
                $response_array['success'] = true;
                $response_code = 200;
                $response = Response::json($response_array, $response_code);
                return $response;
            } else {
                $response_array = array('success' => false, 'error' => 'This Email is not Registered', 'error_code' => 425);
                $response_code = 200;
                $response = Response::json($response_array, $response_code);
                return $response;
            }
        }
    }

    public function token_braintree() {

        //return ('en brain');
        $this->_braintreeConfigure();
        $clientToken = Braintree_ClientToken::generate();
        $response_array = array('success' => true, 'clientToken' => $clientToken);
        $response_code = 200;
        return Response::json($response_array, $response_code);
    }

}
