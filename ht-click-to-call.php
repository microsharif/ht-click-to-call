<?php

/**
 * Plugin Name: HT Click to Call
 * Description: Simplily to appear a calling button in your webpage.
 * Author: 		HasThemes
 * Author URI: 	https://hasthemes.com/
 * Version: 	1.0.0
 * Text Domain: ht-click-call
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly
define( 'CLICK_CALL_PL_ROOT', __FILE__ );
define( 'CLICK_CALL_PL_URL', plugins_url( '/', CLICK_CALL_PL_ROOT ) );
define( 'CLICK_CALL_PL_PATH', plugin_dir_path( CLICK_CALL_PL_ROOT ) );
define( 'CLICK_CALL_PLUGIN_BASE', plugin_basename( CLICK_CALL_PL_ROOT ) );

// Options value fetch
function clickcall_get_option( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

// Required File
require_once ( CLICK_CALL_PL_PATH .'includes/class.clik-call.php' );
