<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{

	return Redirect::to('home');

});

/**
 *
 * Inc Routes
 *
 */

/*
 * Auth
 */
Router::inc('Authentication');


/*
 * Admin
 */
Router::inc('Admin');


/*
 * Website
 */
Router::inc('Website');