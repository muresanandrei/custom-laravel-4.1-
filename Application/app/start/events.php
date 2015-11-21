<?php
/**
 * User: andrei
 * Date: 1/24/14
 * Time: 11:31 PM
 */


/**
 * Needed to handle foreign keys
 *
 * Stop the all foreign keys for this session
 *
 * Usage: \Event::fire('before.insert');
 */
Event::listen('before.insert', function()
{

    \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

});


/**
 * Needed to handle foreign keys
 *
 * Start the all foreign keys for this session
 */
Event::listen('after.insert', function()
{

    \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

});