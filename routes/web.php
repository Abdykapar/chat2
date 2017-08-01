<?php
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;
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
    event(new \App\Events\UserSignedUp(Request::query('author')));
//    Redis::publish('test-channel',json_encode($data));
    return view('welcome');
});
Route::get('create',['as'=>'create','uses'=>'CommentController@create']);
Route::post('/send',['as'=>'send','uses' => 'CommentController@store']);
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');