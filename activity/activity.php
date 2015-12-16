<?php
/**
 * @package Activity
 */
/*
Plugin Name: Activity
Plugin URI: http://autcsa.org.nz/
Description: This is the Activity plugin developed specially for AUTCSA.
Version: 1.0.0
Author: Chad Hao
Author URI: http://chadhao.com/
License: GPLv2
Text Domain: activity
*/

// This file should not be called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'ACTIVITY__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ACTIVITY__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'Activity', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Activity', 'plugin_deactivation' ) );

require_once( ACTIVITY__PLUGIN_DIR . 'class.activity.php' );

add_action( 'init', array( 'Activity', 'init' ) );

function activity_install() {
	$terms = get_terms( 'category', 'orderby=id&hide_empty=0' );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		update_option( 'activity_category', $terms[0]->name );
	} else {
		update_option( 'activity_category', 'Undefined' );
	}
}

function activity_uninstall() {
	delete_option( 'activity_category' );
}


?>