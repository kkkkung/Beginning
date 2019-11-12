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

Route::get('/','PageController@home')->name('home');
Route::get('help', 'PageController@help')->name('help');
Route::get('about', 'PageController@about')->name('about');

Route::get('signup', 'UserController@create')->name('signup');
Route::resource('users', 'UserController');

Route::get('login', 'SessionController@create')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@destroy')->name('logout');

Route::get('test', 'TestController@show');

Route::get('signup/confirm/{activation_token}', 'UserController@completeConfirmEmail')->name('email_confirm');

Route::get('/mailable', function (){
    $user = App\User::find(1);
    return new App\Mail\ConfirmEmail($user);
});


Route::resource('statuses', 'StatusController',['only'=>['store','destroy']]);

Route::get('/users/{user}/followings', 'UserController@followings')->name('users.followings');
Route::get('users/{user}/followers', 'UserController@followers')->name('users.followers');
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset_page');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

