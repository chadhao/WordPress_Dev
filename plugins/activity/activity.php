<?php
/*
Plugin Name: Activity
Plugin URI: http://autcsa.nz/
Description: This is the Activity plugin developed specially for AUTCSA.
Version: 1.0.3
Author: Chad Hao
Author URI: http://chadhao.com/
License: GPLv2
Text Domain: activity
*/

// This file should not be called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define('ACTIVITY__PLUGIN_URL', plugin_dir_url(__FILE__));
define('ACTIVITY__PLUGIN_DIR', plugin_dir_path(__FILE__));

register_activation_hook(__FILE__, array('Activity', 'activity_activation'));
register_deactivation_hook(__FILE__, array('Activity', 'activity_deactivation'));
register_uninstall_hook(__FILE__, array('Activity', 'activity_uninstall'));

require_once ACTIVITY__PLUGIN_DIR.'class.activity.php';
require_once ACTIVITY__PLUGIN_DIR.'class.activity-signup.php';

add_action('init', array('Activity', 'activity_init'));

if (is_admin()) {
    require_once ACTIVITY__PLUGIN_DIR.'class.activity-admin.php';
    add_action('init', array('Activity_Admin', 'activity_admin_init'));
}
