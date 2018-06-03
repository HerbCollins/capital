<?php

Route::group(['middleware' => ['auth:users']], function ($router) {
    $router->get('/', [
        'uses' => 'UserController@index',
        'as' => 'users.index',
    ]);

    $router->post('/ajaxsign' , [
        'uses' => 'SignController@ajaxSign',
        'as' => 'users.sign'
    ]);


    $router->get('/edit' , [
        'uses' => 'UserController@edit',
        'as' => 'users.edit'
    ]);
    $router->post('/update' , [
        'uses' => 'UserController@update',
        'as' => 'users.update'
    ]);


    $router->get('myorder', ['uses' => 'UserController@myorder', 'as' => 'users.auth.myorder']);
    $router->get('sendsell','UserController@sendsell');
    $router->get('getsell','UserController@getsell');
    $router->get('sendbought','UserController@sendbought');
    $router->get('getbought','UserController@getbought');


    $router->get('inviter', ['uses' => 'UserController@inviter', 'as' => 'users.auth.inviter']);
    $router->get('mygroup', ['uses' => 'UserController@mygroup', 'as' => 'users.auth.mygroup']);
    $router->get('mybill', ['uses' => 'UserController@mybill', 'as' => 'users.auth.mybill']);
    $router->get('myminer', ['uses' => 'UserController@myminer', 'as' => 'users.auth.myminer']);
    $router->get('mycash', ['uses' => 'UserController@mycash', 'as' => 'users.auth.mycash']);


    $router->get('withdraw' , ['uses' => 'UserController@withdraw' , 'as' => 'users.auth.withdraw']);
    $router->post('withdraw_result' , ['uses' => 'UserController@withdrawresult' , 'as' => 'users.auth.withdraw_result']);
    $router->get('recharge' , ['uses' => 'UserController@recharge' , 'as' => 'users.auth.recharge']);
    $router->post('ajaxrecharge' , ['uses' => 'UserController@ajaxrecharge' , 'as' => 'users.auth.ajaxrecharge']);

    $router->get('reset' , ['uses' => 'UserController@reset' , 'as' => 'users.auth.reset']);
    $router->post('ajaxreset' , ['uses' => 'UserController@ajaxreset' , 'as' => 'users.auth.ajaxreset']);
    $router->get('payment' , ['uses' => 'UserController@payment' , 'as' => 'users.auth.payment']);
    $router->post('ajaxpayment' , ['uses' => 'UserController@ajaxpayment' , 'as' => 'users.auth.ajaxpayment']);

});

Route::get('login', ['uses' => 'AuthController@index', 'as' => 'users.auth.index',]);

Route::post('login', ['uses' => 'AuthController@login', 'as' => 'users.auth.login',]);

Route::get('logout', ['uses' => 'AuthController@logout', 'as' => 'users.auth.logout',]);

Route::get('register/{code?}', ['uses' => 'AuthController@getRegister', 'as' => 'users.auth.register',]);

Route::post('register', ['uses' => 'AuthController@postRegister', 'as' => 'users.auth.register',]);

Route::get('password/reset/{token?}', ['uses' => 'PasswordController@showResetForm', 'as' => 'users.password.reset',]);

Route::post('password/reset', ['uses' => 'PasswordController@reset', 'as' => 'users.password.reset',]);

Route::post('password/email', ['uses' => 'PasswordController@sendResetLinkEmail', 'as' => 'users.password.email',]);
