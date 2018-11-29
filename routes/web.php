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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
});

Auth::routes();

Route::get('/{user}', 'HomeController@index')->name('home');

Route::get('/{user}/jobs', 'JobController@create')->name('jobs.create');
Route::post('/{user}/jobs', 'JobController@store');

Route::group(['prefix' => '{user}/'], function()
{
    Route::resource('jobs', 'JobController');
});

