<?php

Route::get('/home', function () {
    if (session('status')) {
        //return dd(session('status'));
        return redirect()->route('admin.shops.index')->with('status', session('status'));
    }
      //return dd(session('status'));
    return redirect()->route('admin.shops.index');
});



Route::get('/', 'HomeController@index')->name('home');
Route::get('shop/{shop}', 'HomeController@show')->name('shop');

//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@showResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::post('password/confirm','Auth\ConfirmPasswordController@confirm');
Route::get('password/confirm','Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//Route::resetPassword();
//Route::emailVerification();

/*
Route::group(['prefix' => '', 'as' => 'user', 'namespace' => 'User'], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/walker/login', array('as' => 'WalkerLogin', 'uses' => 'WalkerController@ShowLoginWalker'));
    Route::post('/walker/verify', array('as' => 'WalkerVerify', 'uses' => 'WalkerController@walkerVerify'));
    Route::get('/walker/logout', array('as' => 'WalkerLogout', 'uses' => 'WalkerController@logout'));
    Route::get('/walker/availability', array(
      'as' => 'walkerAvail',
      'uses' => 'WebUserController@walkeravailability'
    ));
    Route::get('/walker/tripinprogress', array(
    'as' => 'walkerTripInProgress',
    'uses' => 'WebUserController@walkerTripInProgress'));
    Route::get('/walker/request', array(
        'as' => 'walkerRequestPing',
        'uses' => 'WebProviderController@walkerRequestPing'));
    // Routes Users
    Route::get('/user/signin', array('as' => 'UserLogin', 'uses' =>'MarketplaceController@userLogin'));
    Route::get('/usuarios/registro', array('as' => '/user/signup', 'uses' => 'WebUserController@userRegister'));
    Route::get('/usuarios/entrar', array('as' => '/user/signin', 'uses' => 'MarketplaceController@userLogin'));
    Route::post('/user/save', array('as' => '/user/save', 'uses' => 'WebUserController@userSave'));
    //Route::post('/user/save_fb', array('as' => '/user/save_fb', 'uses' => 'WebUserController@userSaveFB'));
    Route::post('/user/forgot-password', array('as' => '/user/forgot-password', 'uses' => 'WebUserController@userForgotPassword'));
    Route::get('/user/logout', array('as' => '/user/logout', 'uses' => 'WebUserController@userLogout'));
    Route::get('/user/payments', array('as' => 'userPayment', 'uses' => 'WebUserController@userPayments'));

    Route::get('/user/profile', array('as' => '/user/profile', 'uses' => 'WebUserController@userProfile'));

    Route::get('/user/trip/{id}', 'WebUserController@userTripDetail')->name('users.userTrip');
    Route::post('owner/verify', array('as' => 'ownerVerify', 'uses' => 'OwnerController@ownerVerify'));
    Route::post('/user/verify', array('as' => 'userVerify', 'uses' => 'WebUserController@userVerify'));
    Route::post('/usuarios/user/verify', array('as' => '/user/verify', 'uses' => 'WebUserController@userVerify'));
    Route::get('/user/trips', array('as' => 'userTrips', 'uses' => 'WebUserController@userTrips'));
    //Route::get('/trips', array('as' => '/trips', 'uses' => 'WebUserController@userTrips'))->name('userTrips');

    Route::get('/user/trip/status/{id?}', array('as' => '/user/trip/status', 'uses' => 'WebUserController@userTripStatus'));

    Route::get('/user/trip/cancel/{id}', array('as' => '/user/trip/cancel', 'uses' => 'WebUserController@userTripCancel'));

    Route::get('/find', array('as' => '/find', 'uses' => 'WebUserController@surroundingCars'));

    Route::get('user/paybypaypal/{id}', array('as' => 'user/paybypaypal', 'uses' => 'WebUserController@webpaybypaypal'));

    Route::get('user/paybypalweb/{id}', array('as' => 'user/paybypalweb', 'uses' => 'WebUserController@paybypalwebSubmit'));

    Route::get('userpaypalstatus', array('as' => 'userpaypalstatus', 'uses' => 'WebUserController@paypalstatus'));

    Route::get('userpaypalipn', array('as' => 'userpaypalipn', 'uses' => 'WebUserController@userpaypalipn'));

    Route::get('/user/request-trip', array('as' => 'userrequestTrip', 'uses' => 'WebUserController@userRequestTrip'));
    Route::get('/user/request-trip2', array('as' => 'userrequestTrip2', 'uses' => 'WebUserController@userRequestTrip2'));
});
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Shops
    Route::delete('shops/destroy', 'ShopsController@massDestroy')->name('shops.massDestroy');
    Route::post('shops/media', 'ShopsController@storeMedia')->name('shops.storeMedia');
    Route::resource('shops', 'ShopsController');
  //  Route::get('/shops',  array('as' => 'admin.shops.index', 'uses' => 'ShopsController'));
});
