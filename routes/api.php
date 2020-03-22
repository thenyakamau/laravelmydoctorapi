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

Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('registerDoctor', 'Api\Auth\RegisterController@registerDoctor');
Route::post('registerPatient', 'Api\Auth\RegisterController@registerPatient');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');

Route::get('resendVerification', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('email/verify', 'Auth\VerificationController@verify')->name('verification.verify');

Route::post('sendResetLinkEmail', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('resetPassword', 'Api\Auth\ResetPasswordController@reset')->name('password.reset');

Route::middleware('auth:api')->group(function () {

    Route::post('logout', 'Api\Auth\LoginController@logout');

    Route::get('posts', 'Api\PostController@index');

    Route::get('patientDetails', 'Api\patientDetails@patientDetails');

    Route::get('fetchChatMessages', 'Api\ChatMessagesController@fetchChatMessages');


});
