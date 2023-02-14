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
 * @author   Utsav Ladani <username@example.com>
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

}//end My_Plugin_activate()


register_activation_hook(__FILE__, 'My_Plugin_activate');


/**
 * Undocumented function
 *
 * @return void
 */
function My_Plugin_deactivate()
{
    // echo "bye";

}//end My_Plugin_deactivate()


register_deactivation_hook(__FILE__, 'My_Plugin_deactivate');


/**
 * Undocumented function
 *
 * @param mixed $arg1 first
 * @param mixed $arg2 second
 *
 * @return void
 */
function Example_callback($arg1, $arg2)
{
    echo $arg1.' '.$arg2;

}//end Example_callback()


add_action('example_action', 'Example_callback', 10, 2);


/**
 * Undocumented function
 *
 * @param mixed $arg1 first
 *
 * @return void
 */
function Example2_callback($arg1)
{
    echo $arg1;

}//end Example2_callback()


add_action('example_action', 'Example2_callback', 10, 1);

remove_action('example_action', 'Example2_callback', 10);

// do_action('example_action', '123', 'abc', '1234');
// do_action('example_action', '12', 'ab');
// Filters
add_filter(
    'my_tag',
    function ($arg) {
        echo "just $arg <br />";
        return $arg.'!';
    }
);

add_action(
    'my_tag',
    function ($arg) {
        echo "another just $arg <br />";
        return $arg.'|';
    }
);

// here filter and action bechaves like same.
// echo apply_filters('my_tag', 'nothing') . '<br />';
// echo do_action('my_tag') . '<br />';
// all
// can be use for quick hook debugging
// add_action(
// 'all',
// function ( $hook ) {
// echo '<br /> run: ' . $hook . '<br />';
// }
// );
// do_action('my_tag', 'Hello');
// Hooks: gettext vs gettext_with_context


/**
 * Add the '-' and break at the end of each text
 *
 * @param [string] $translated_text translated text
 * @param [string] $text            text
 * @param [string] $text_domin      text domain
 *
 * @return string
 */
function Check_gettext($translated_text, $text, $text_domin)
{
    return $translated_text.'-<br />';

}//end Check_gettext()


// add_filter('gettext', 'Check_gettext', 10, 3);
// output: text-<br />
// echo apply_filters('gettext', 'Hello', 'Hello', 'my-plugin');


/**
 * Add the '=' and break at the end of each text.
 * It's used to chagne the text with context
 *
 * @param [string] $translated_text translated text
 * @param [string] $text            text
 * @param [string] $context         context
 * @param [string] $text_domin      text domain
 *
 * @return string
 */
function Check_Gettext_With_context($translated_text, $text, $context, $text_domin)
{
    return $translated_text.'=<br />';

}//end Check_Gettext_With_context()


// add_filter('gettext_with_context', 'Check_Gettext_With_context', 10, 4);
// output: text=<br />
// echo apply_filters(
// 'gettext_with_context',
// '10 Comments',
// '10 Comments',
// 'Comments',
// 'my-plugin'
// );
// alloption
// print_r(get_alloptions());
// echo get_alloptions()['admin_email'] . '<br />';


/**
 * Override the options
 *
 * @param array $alloptions all options
 *
 * @return array
 */
function My_Alloptions_filter($alloptions)
{
    $alloptions['admin_email'] = 'temp@email.com';
    return $alloptions;

}//end My_Alloptions_filter()


// add_filter('alloptions', 'My_Alloptions_filter');
// echo get_alloptions()['admin_email'] . '<br />';
// echo wp_load_alloptions()['admin_email'] . '<br />';


/**
 * Check How Many Times Alloptions run
 *
 * @return void
 */
function Check_How_Many_Times_Alloptions_run()
{
    static $count = 0;
    $count++;
    echo 'Run: '.$count.'<br />';

}//end Check_How_Many_Times_Alloptions_run()


// add_action('alloptions', 'Check_How_Many_Times_Alloptions_run', 10, 0);


/**
 * Change the option before is execute.
 *
 * @param [type] $pre_option pre option
 *
 * @return void
 */
function Wp_Docs_Pre_Filter_option($pre_option)
{
    if (! is_home()) {
        return $pre_option;
    }

    return 'My Awesome Homepage';

}//end Wp_Docs_Pre_Filter_option()


// add_filter('pre_option_blogname', 'wp_docs_pre_filter_option');


/**
 * Used to change the active_plugins option before fetching it from database.
 *
 * @param string $pre_option pre option value
 *
 * @return void
 */
function Pre_Filter_Option_Active_plugins($pre_option)
{
    $plugins[] = 'my-plugin/my-plugin.php';
    // $plugins[] = 'hello-dolly/hello.php';
    return $plugins;

}//end Pre_Filter_Option_Active_plugins()


// add_filter('pre_option_active_plugins', 'Pre_Filter_Option_Active_plugins');
add_action(
    'all',
    function () {
        $args = func_get_args();
        foreach ($args as &$arg) {
            if (is_object($arg)) {
                $arg = get_class($arg);
            }

            if (empty($arg)) {
                $arg = 'false';
            }
        }

        $hook = array_shift($args);
        if (! in_array($hook, ['gettext', 'gettext_with_context'])
            && false === strpos($hook, 'option')
            && false === strpos($hook, 'user')
        ) {
            return;
        }

        $avoid = false;
        foreach ($args as &$arg) {
            if (is_array($arg)) {
                $avoid = true;
            }
        }

        if (! $avoid) {
            $args = implode(', ', $args);
            error_log($hook.( ! empty($args) ? ': '.$args : '' ));
        }
    }
);


// replace every block with image :)
add_filter(
    'render_block',
    function ($block) {
        return '<img src="https://placekitten.com/'.rand(200, 400).'" />';
    }
);


 /**
  * Used to view output
  *
  * @return void
  */
function hello()
{
    die('Do you like death');

}//end hello()


 // hello();
