<?php

class Activity {
	private static $initialed = false;
	
	public static function init() {
		if ( !self::$initialed ) {
			self::init_hooks();
		}
	}
	
	public static function plugin_activation() {
		
	}
	
	public static function plugin_deactivation() {
		
	}

	/**
	 * Initialize wordpress hooks
	 */
	private static function init_hooks() {
		
	}
}

?>
