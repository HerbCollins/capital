<?php

Route::group(['middleware' => ['auth:admin']], function ($router) {
    $router->get('/', ['uses' => 'AdminController@index', 'as' => 'admin.index']);

    $router->get('/system', ['uses' => 'AdminController@system', 'as' => 'admin.system']);
    $router->post('/system/setting', ['uses' => 'AdminController@systemsetting', 'as' => 'admin.system.setting']);

    $router->resource('index', 'IndexController');

    //目录
    $router->resource('menus', 'MenuController');

    //后台用户
    $router->get('adminuser/ajaxIndex', ['uses' => 'AdminUserController@ajaxIndex', 'as' => 'admin.adminuser.ajaxIndex']);
    $router->resource('adminuser', 'AdminUserController');

    //权限管理
    $router->get('permission/ajaxIndex', ['uses' => 'PermissionController@ajaxIndex', 'as' => 'admin.permission.ajaxIndex']);
    $router->resource('permission', 'PermissionController');

    //角色管理
    $router->get('role/ajaxIndex', ['uses' => 'RoleController@ajaxIndex', 'as' => 'admin.role.ajaxIndex']);

    $router->resource('role', 'RoleController');

    $router->resource('users', 'UserController');

    $router->resource('miners', 'MinerController');

    $router->resource('userminers', 'UserMinerController');

    $router->resource('coinprices', 'PriceController');

    $router->resource('orders', 'OrderController');
    $router->resource('notices', 'NoticeController');

    $router->get('orders/type/{type}', 'OrderController@lists')->name('admin.orders.type');

    $router->post('coinprices/axis', 'PriceController@axis')->name('admin.coinprices.axis');

    $router->get('cashs/draw' , 'CashController@draw')->name('admin.cashs.draw');
    $router->get('cashs/recharge' , 'CashController@recharge')->name('admin.cashs.recharge');
    $router->get('cashs/recharge_list' , 'CashController@rechargelist')->name('admin.cashs.rechargelist');
    $router->post('cashs/recharge/dealrecharge' , 'CashController@dealrecharge')->name('admin.cashs.dealrecharge');
    $router->get('cashs/draw/reply/{id}' , 'CashController@reply')->name('admin.cashs.reply');
    $router->get('cashs/draw/dealed/{id}' , 'CashController@dealed')->name('admin.cashs.deal');

});


Route::get('login', ['uses' => 'AuthController@index', 'as' => 'admin.auth.index']);
Route::post('login', ['uses' => 'AuthController@login', 'as' => 'admin.auth.login']);

Route::get('logout', ['uses' => 'AuthController@logout', 'as' => 'admin.auth.logout']);

Route::get('register', ['uses' => 'AuthController@getRegister', 'as' => 'admin.auth.register']);
Route::post('register', ['uses' => 'AuthController@postRegister', 'as' => 'admin.auth.register']);

Route::get('password/reset/{token?}', ['uses' => 'PasswordController@showResetForm', 'as' => 'admin.password.reset']);
Route::post('password/reset', ['uses' => 'PasswordController@reset', 'as' => 'admin.password.reset']);
Route::post('password/email', ['uses' => 'PasswordController@sendResetLinkEmail', 'as' => 'admin.password.email']);
