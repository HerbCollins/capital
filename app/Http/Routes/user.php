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

    $router->get('myorder', ['uses' => 'UserController@myorder', 'as' => 'users.auth.myorder']);
    $router->get('sendsell','UserController@sendsell');
    $router->get('getsell','UserController@getsell');
    $router->get('sendbought','UserController@sendbought');
    $router->get('getbought','UserController@getbought');


    $router->get('inviter', ['uses' => 'UserController@inviter', 'as' => 'users.auth.inviter']);
    $router->get('mygroup', ['uses' => 'UserController@mygroup', 'as' => 'users.auth.mygroup']);
    $router->get('mybill', ['uses' => 'UserController@mybill', 'as' => 'users.auth.mybill']);
    $router->get('myminer', ['uses' => 'UserController@myminer', 'as' => 'users.auth.myminer']);

});

Route::get('login', ['uses' => 'AuthController@index', 'as' => 'users.auth.index',]);

Route::post('login', ['uses' => 'AuthController@login', 'as' => 'users.auth.login',]);

Route::get('logout', ['uses' => 'AuthController@logout', 'as' => 'users.auth.logout',]);

Route::get('register/{code?}', ['uses' => 'AuthController@getRegister', 'as' => 'users.auth.register',]);

Route::post('register', ['uses' => 'AuthController@postRegister', 'as' => 'users.auth.register',]);

Route::get('password/reset/{token?}', ['uses' => 'PasswordController@showResetForm', 'as' => 'users.password.reset',]);

Route::post('password/reset', ['uses' => 'PasswordController@reset', 'as' => 'users.password.reset',]);

Route::post('password/email', ['uses' => 'PasswordController@sendResetLinkEmail', 'as' => 'users.password.email',]);
