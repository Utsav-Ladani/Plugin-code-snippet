<?php

/**
 * Plugin Name: My Plugin
 * Plugin URI:  my-plugin
 * Author:      Utsav
 * Author URI:  https://example.com
 * Description: This the test plugin
 * Version:     1.0.0
 * PHP Version: 8.2.0
 * License:     MIT
 * License URL: https://mit.edu/
 * text-domain: my-plugin
 * 
 * @category Plugin
 * @package  WordPress
 * @author   Utsav <email@email.com>
 * @license  MIT https://mit.edu/
 * @link     http://url.com
 */

/**
 * Undocumented function
 *
 * @return void
 */
function My_Plugin_activate()
{
    // echo "hi";
}

register_activation_hook(__FILE__, 'My_Plugin_activate');

/**
 * Undocumented function
 *
 * @return void
 */
function My_Plugin_deactivate()
{
    // echo "bye";
}

register_deactivation_hook(__FILE__, 'My_Plugin_deactivate');

/**
 * Undocumented function
 *
 * @param mixed $arg1 first
 * @param mixed $arg2 second
 * 
 * @return void
 */
function Example_callback( $arg1, $arg2 )
{
    echo $arg1.' '.$arg2;
}
add_action('example_action', 'Example_callback', 10, 2);

/**
 * Undocumented function
 *
 * @param mixed $arg1 first
 * 
 * @return void
 */
function Example2_callback( $arg1 )
{
    echo $arg1;
}
add_action('example_action', 'Example2_callback', 10, 1);

remove_action('example_action', 'Example2_callback', 10);

// do_action('example_action', '123', 'abc', '1234');
// do_action('example_action', '12', 'ab');

// Filters

add_filter(
    'my_tag', 
    function ($arg) {
        echo 'just<br />';
        return $arg . '!';
    }
);

add_action(
    'my_tag', 
    function ($arg) {
        echo 'another just <br />';
        return $arg;
    }
);

// here filter and action bechaves like same.
echo apply_filters('my_tag', 'nothing') . '<br />';
echo do_action('my_tag') . '<br />';

/**
 * Used to view output
 *
 * @return void
 */
function hello()
{
    die("Do you like death");
}

hello();
