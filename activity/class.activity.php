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
		
		if ( $activity_init_current_option != 'false' ) {
			foreach ( $activity_init_terms as $activity_init_term ) {
				if ( $activity_init_current_option == $activity_init_term->term_id ) {
					return;
				}
			}
		}
		
		if ( ! empty( $activity_init_terms ) && ! is_wp_error( $activity_init_terms ) ) {
			update_option( 'activity_category', $activity_init_terms[0]->term_id );
		} else {
			update_option( 'activity_category', 0 );
		}
		
		self::init_database();
	}
	
	public static function plugin_deactivation() {
		
	}
	
	/**
	 * Initialize plugin database
	 */
	private static function init_database() {
		global $wpdb;
		$activity_table_name = $wpdb->prefix . "activity_signup";
		$activity_charset_collate = $wpdb->get_charset_collate();
		
		$activity_sql = "CREATE TABLE $activity_table_name (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT  PRIMARY KEY,
			activity_id bigint(20) unsigned NOT NULL,
			name varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			phone varchar(15) NOT NULL,
			fee_paid boolean DEFAULT false NOT NULL,
			is_aut_student boolean DEFAULT false NOT NULL,
			is_autcsa_member boolean DEFAULT false NOT NULL,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL
		) $activity_charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $activity_sql );
	}

	/**
	 * Initialize wordpress hooks
	 */
	private static function init_hooks() {
		
	}
}

?>