<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:26 AM
 */

Route::filter('admin_session', 'CoreApp\Admin\Filters\Admin');

Route::when('admin/*', 'admin_session');