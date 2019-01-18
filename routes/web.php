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

 Route::get('/', function () {
     return view('coba0');
 });

Route::post('/coba', 'coba_controller@read_file');
//Route::post('/coba0', 'coba_controller@read_file0');
