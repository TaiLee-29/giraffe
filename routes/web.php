<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::resource('/', \App\Http\Controllers\PostController::class);
Route::get('/geo',[\App\Http\Controllers\geo\GeoIpRouterController::class,'route']);
Route::middleware('guest')->group(function (){
    Route::get('/auth/login',[\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/auth/login',[\App\Http\Controllers\AuthController::class, 'handleLogin'])->name('handle-login');


});
Route::get('/yahoo/callback',\App\Http\Controllers\OAuth\YahooController::class)->name('yahoo');
Route::get('/github/callback',\App\Http\Controllers\OAuth\GitHubController::class)->name('git');
Route::get('/author/{id}', \App\Http\Controllers\PostByAuthorController::class)->name('post-by-author');
Route::get('/','\App\Http\Controllers\PostController@index')->name('index');
Route::get('/{id}','\App\Http\Controllers\PostController@show')->name('show')->where('id', '[0-9]+');

Route::middleware('auth')->group(function(){
Route::get('/auth/logout',[\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/edit','\App\Http\Controllers\PostController@create')->name('create');
Route::post('/{post}','\App\Http\Controllers\PostController@store')->name('store');
Route::get('/edit/{post}','\App\Http\Controllers\PostController@edit')->name('edit');
Route::post('/edit/{post}','\App\Http\Controllers\PostController@update')->name('update');
Route::delete('/delete/{post}','\App\Http\Controllers\PostController@destroy')->name('delete');

});
