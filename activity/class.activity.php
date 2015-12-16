<?php

class Activity {
	private static $initialed = false;
	
	public static function init() {
		if ( !self::$initialed ) {
			self::init_hooks();
		}
	}
	
	public static function plugin_activation() {
		$activity_init_terms = get_terms( 'category', 'orderby=id&hide_empty=0' );
		$activity_init_current_option = get_option( 'activity_category', 'false' );
		$activity_init_is_current_option_matches_term = false;
		
		if ( $activity_init_current_option != 'false' ) {
			foreach ( $activity_init_terms as $activity_init_term ) {
				if ( $activity_init_current_option == $activity_init_term->name ) {
					$activity_init_is_current_option_matches_term = true;
					break;
				}
			}
		}
		
		if ( ! $activity_init_is_current_option_matches_term  )
		{
			if ( ! empty( $activity_init_terms ) && ! is_wp_error( $activity_init_terms ) ) {
				update_option( 'activity_category', $activity_init_terms[0]->name );
			} else {
				update_option( 'activity_category', 'Undefined' );
			}
		}
		
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
