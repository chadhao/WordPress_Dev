<?php

class Activity_Admin {
	private static $activity_admin_initialed = false;
	
	public static function activity_admin_init() {
		if ( ! self::$activity_admin_initialed ) {
			self::activity_admin_init_hooks();
		}
	}
	
	public static function activity_admin_init_hooks() {
		self::$activity_admin_initialed = true;
		
		add_action( 'admin_menu', array( 'Activity_Admin', 'activity_admin_load_menu' ) );
	}
	
	public static function activity_admin_load_menu() {
		add_menu_page( '活动列表', '活动', 'edit_posts', 'activity_admin', array( 'Activity_Admin', 'activity_admin_display_activity' ), 'dashicons-carrot', 6 );
		add_submenu_page( 'activity_admin', '活动列表', '活动列表', 'edit_posts', 'activity_admin', array( 'Activity_Admin', 'activity_admin_display_activity' ) );
		add_submenu_page( 'activity_admin', '活动设置', '活动设置', 'edit_posts', 'activity_admin_setting', array( 'Activity_Admin', 'activity_admin_display_setting' ) );
	}
	
	public static function activity_admin_display_activity() {
		echo '
			<div class="wrap">
			<h1>activity list</h1>
			</div>
		';
	}
	
	public static function activity_admin_display_setting() {
		echo '
			<div class="wrap">
			<h1>activity plugin setting</h1>
			</div>
		';
	}
}

?>