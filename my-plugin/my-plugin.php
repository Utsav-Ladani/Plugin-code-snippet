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
    echo "hi";
}

register_activation_hook(__FILE__, 'My_Plugin_activate');

/**
 * Undocumented function
 *
 * @return void
 */
function My_Plugin_deactivate()
{
    echo "bye";
}

register_deactivation_hook(__FILE__, 'My_Plugin_deactivate');
