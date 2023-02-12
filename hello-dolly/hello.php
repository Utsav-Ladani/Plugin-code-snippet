<?php
/**
 * Plugin Name: Hello Dolly
 * Plugin URI: http://wordpress.org/plugins/hello-dolly/
 * Description: Nothing
 * Author: Matt Mullenweg
 * Version: 1.7.2
 * PHP Version: 8.1
 * Author URI: http://ma.tt/
 * 
 * @category Description
 * @package  Hello_Dolly
 * @author   Name <email@email.com>
 * @license  MIT https://example.com/
 * @link     https://example.com
 */

/**
 * Undocumented function
 *
 * @return void
 */
function Hello_dolly() 
{
    // printf("<div id='dolly'>Utsav</div>");

    // $str = "
    // <div>Hello hi 
    //     <a href='mailto://www.example.com/'>Click to xmls://www.example.com/</a>
    // </div>";
    // // $str= "google.com";
    // echo wp_kses(
    //     $str,
    //     array(
    //         'a' => array(
    //             'href' => array()
    //         )
    //     ),
    //     array(
    //         'https'
    //     )
    // );

    $url = "https://test.local/";
    echo wp_nonce_url($url, '', 'just_check_nonce')."<br />";
    echo wp_nonce_url($url, '', 'just_check_nonce_another')."<br />";
    echo esc_html(wp_nonce_field(referer:true)) ."<br />";
    echo esc_html(wp_nonce_field('hello_dolly_test')) ."<br />";

    echo wp_create_nonce()."<br />";
    echo wp_verify_nonce(wp_create_nonce())."<br />";
    ?>
    <form action="#" method="post">
    <?php
        echo wp_nonce_field('hello_dolly_test', 'first_nonce');
    ?>
    <input type="submit" value="Okay" />
    </form>
    <?php

    if (isset($_POST['first_nonce'])
        && wp_verify_nonce($_POST['first_nonce'], 'hello_dolly_test')
    ) {
        echo "Yeah<br />";
    }
}

// Now we set that function up to execute when the admin_notices action is called.
// add_action('admin_notices', 'Hello_dolly');

/**
 * Undocumented function
 *
 * @return void
 */
function Dolly_css()
{
    echo "
    <style>
        #dolly {
            color: red;
            background-color: yellow;
        }
    </style>
    ";
}

// add_action('admin_head', 'Dolly_css');
