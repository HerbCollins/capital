<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => ['web']], function () {
    Route::get('/' , 'HomeController@index');

    Route::get('/coins' , 'CoinController@index');

    Route::post('/coins/miner/buyorder' , [
        'uses' => 'CoinController@buyOrder',
        'as' => 'users.miner.buyorder'
    ]);

    Route::post('/coins/miner/payment' , [
        'uses' => 'CoinController@payment',
        'as' => 'users.miner.payment'
    ]);

    Route::get('/transaction' , 'TransactionController@index');
    Route::post('/transaction/ajaxdata' , 'TransactionController@ajaxData');
    Route::post('/transaction/boughtorder' , 'TransactionController@boughtOrder');
    Route::post('/transaction/sellorder' , 'TransactionController@sellOrder');

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        require app_path('Http/Routes/user.php');
    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        require app_path('Http/Routes/admin.php');
    });
});
