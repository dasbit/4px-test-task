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
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function (Router $router){
    $router->get('/home', 'HomeController@index')->name('home');
    $router->resource('/users', 'UsersController', ['except' => 'show']);
    $router->resource('/sections', 'SectionsController', ['except' => 'show']);
});

