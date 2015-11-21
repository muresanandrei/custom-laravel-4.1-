<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:34 AM
 */

Route::get('login', 'CoreApp\Authentication\Controllers\Login@index');

Route::post('login', 'CoreApp\Authentication\Controllers\ProcessLogin@index');

Route::post('forgot-password', 'CoreApp\Authentication\Controllers\ProcessForgotPassword@index');

Route::get('reset/{string}', 'CoreApp\Authentication\Controllers\ProcessResetPassword@index');


Route::get('logout', function(){

    \SystemTools\UserSession::destroy_session();

    //just to be very sure:
    \Session::flush();

    return \Redirect::to('login');

});