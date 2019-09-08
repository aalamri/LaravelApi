<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/register', 'APIRegisterController@register');
Route::post('user/login', 'APILoginController@login');

Route::middleware('jwt.auth')->post('/users', function (Request $request) {
    return $request->user();
});

//Route::middleware('jwt.auth')->group(function(){
Route::resource('books', 'API\BookController');
Route::middleware('jwt.auth')->resource('favorites', 'API\FavoritesController');
Route::middleware('jwt.auth')->resource('orders', 'API\OrdersController');
Route::middleware('jwt.auth')->post('orders/index', 'API\OrdersController@index');
Route::middleware('jwt.auth')->post('orders/cancel', 'API\OrdersController@cancel');
Route::middleware('jwt.auth')->post('orders/confirm', 'API\OrdersController@confirm');
Route::middleware('jwt.auth')->post('favorites/index', 'API\FavoritesController@index');
//});
