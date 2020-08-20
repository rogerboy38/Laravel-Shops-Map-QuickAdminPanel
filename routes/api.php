<?php
use Illuminate\Http\Request;

/*
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
  Route::post('apiLogin',array('as' => 'apiLogin', 'uses' => 'AuthController@login'));

});*/
Route::group(['prefix' => 'v1', 'as' => 'api', 'namespace' => 'Api\V1\Admin'], function () {
  Route::get('apiGetCategory', array('as' => 'apiGetCategory', 'uses' => 'ApplicationController@apiGetCategory'));
  Route::get('apiGetShop', array('as' => 'apiGetShop', 'uses' => 'ApplicationController@apiGetShop'));
  Route::get('apiGetShop/{id}', array('as' => 'apiGetShop', 'uses' => 'ApplicationController@apiGetShop'));
  Route::post('apiLogin', array('as' => 'apiLogin', 'uses' => 'AuthController@login'));
  Route::post('apiLogout', array('as' => 'apiLogout', 'uses' => 'AuthController@logout'));
  Route::post('apiRefresh', array('as' => 'apiRefresh', 'uses' => 'AuthController@refresh'));
  Route::post('apiRegister', array('as' => 'apiRegister', 'uses' => 'AuthController@register'));
  Route::get('apiGetShopsInCategory/{id}', array('as' => 'apiGetShopsInCategory', 'uses' => 'ApplicationController@apiGetShopsInCategory'));
  Route::get('apiShopShow/{id}', array('as' => 'apiShopShow', 'uses' => 'ApplicationController@apiShopShow'));

});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {


    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Shops
    Route::post('shops/media', 'ShopsApiController@storeMedia')->name('shops.storeMedia');
    Route::apiResource('shops', 'ShopsApiController');
});


Route::group(['prefix' => 'v1/element', 'as' => 'api', 'namespace' => 'Api\V1\Menus', 'middleware' =>  ['auth:api']], function ($router) {
          Route::get('/menu', 'MenuController@index');
//    Route::prefix('menu/element')->group(function () {
          Route::get('/',             'MenuElementController@index')->name('menu.index');
          Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
          Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
          Route::get('/create',       'MenuElementController@create')->name('menu.create');
          Route::post('/store',       'MenuElementController@store')->name('menu.store');
          Route::get('/get-parents',  'MenuElementController@getParents');
          Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
          Route::post('/update',      'MenuElementController@update')->name('menu.update');
          Route::get('/show',         'MenuElementController@show')->name('menu.show');
          Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
      });


/*
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' =>  ['api']], function ($router) {
    Route::get('menu', 'MenuController@index');




    Route::resource('notes', 'NotesController');

    Route::resource('resource/{table}/resource', 'ResourceController');

    Route::group(['middleware' => 'admin'], function ($router) {

        Route::resource('mail',        'MailController');
        Route::get('prepareSend/{id}', 'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}',   'MailController@send')->name('mailSend');

        Route::resource('bread',  'BreadController');   //create BREAD (resource)

        Route::resource('users', 'UsersController')->except( ['create', 'store'] );
*/
/*
        Route::prefix('menu/menu')->group(function () {
            Route::get('/',         'MenuEditController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuEditController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuEditController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuEditController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuEditController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuEditController@delete')->name('menu.menu.delete');
        });

  */

/*        Route::prefix('media')->group(function ($router) {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');

            Route::get('/file/download',    'MediaController@fileDownload');
        });

        Route::resource('roles',        'RolesController');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
    });

});*/
