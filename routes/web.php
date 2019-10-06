<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
function isActive($status){
    if($status=="1"){
        return "Active";
    }
    return "Blocked";

}
Route::get('/', function () {
    return view('welcome');
});


