<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:34 AM
 */

App::bind('AuthenticationModel', 'CoreApp\Authentication\Models\Authentication');

App::bind('AuthenticationUserTypeModel', 'CoreApp\Authentication\Models\AuthenticationUserType');

App::bind('ForgotPasswordModel', 'CoreApp\Authentication\Models\ForgotPassword');