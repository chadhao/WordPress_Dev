<?php

class Activity_Admin {
	const NONCE = 'activity_admin_key';
	
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
		add_menu_page( '活动列表', '活动', 'edit_posts', 'activity_admin', array( 'Activity_Admin', 'activity_admin_page' ), 'dashicons-carrot', 6 );
		add_submenu_page( 'activity_admin', '活动列表', '活动列表', 'edit_posts', 'activity_admin', array( 'Activity_Admin', 'activity_admin_page' ) );
		add_submenu_page( 'activity_admin', '活动设置', '活动设置', 'edit_posts', 'activity_admin_setting', array( 'Activity_Admin', 'activity_admin_setting' ) );
	}
	
	public static function activity_admin_page() {
		if ( isset( $_GET['action'] ) )
		{
			if ( $_GET['action'] == 'activity_admin_setting' ) {
				self::activity_admin_setting();
			} else if ( $_GET['action'] == 'activity_admin_delete_post' ) {
				self::activity_admin_delete_post();
			}
			
		} else {
			self::activity_admin_display_activity();
		}
	}
	
	public static function activity_admin_get_url( $action, $post_id=0 ) {
		if ( $action == 'activity_admin_delete_post' ) {
			$args = array( 'page' => 'activity_admin', 'action' => $action, 'post_id' => $post_id, '_wpnonce' => wp_create_nonce( self::NONCE ) );
		} else {
			$args = array( 'page' => 'activity_admin', 'action' => $action, '_wpnonce' => wp_create_nonce( self::NONCE ) );
		}
		$url = add_query_arg( $args, admin_url( 'admin.php' ) );
		return $url;
	}
	
	public static function activity_admin_term_exists( $term ) {
		$all_terms = get_terms( 'category', 'orderby=id&hide_empty=0' );
		foreach ( $all_terms as $a_term ) {
			if ( $a_term->term_id == $term )
			{
				return true;
			}
		}
		return false;
	}
	
	public static function activity_admin_message( $type, $msg ) {
		if ( $type == 'error' ) {
			echo '<div class="error"><p>' . $msg . '</p></div>'; 
		} else {
			echo '<div class="updated"><p>' . $msg . '</p></div>';
		}
	}
	
	public static function activity_admin_display_message( $type, $msg ) {
		add_action( 'admin_notice', array( 'Activity_Admin', 'activity_admin_message' ), 10, 2 );
		do_action( 'admin_notice', $type, $msg);
	}
	
	public static function activity_admin_display_activity() {
		Activity::activity_view( 'activity_admin_list' );
	}
	
	public static function activity_admin_setting() {
		
		if ( isset($_GET['_wpnonce']) ) {
			if ( wp_verify_nonce( $_GET['_wpnonce'], self::NONCE ) && isset( $_POST['activity_category'] ) && self::activity_admin_term_exists( $_POST['activity_category'] ) ) {
				update_option( 'activity_category', $_POST['activity_category'] );
				self::activity_admin_display_message( 'updated', '活动分类更新成功！' );
			} else {
				self::activity_admin_display_message( 'error', '非法请求！' );
			}
		}
		
		Activity::activity_view( 'activity_admin_setting' );
	}
	
	public static function activity_admin_delete_post() {
		if ( wp_verify_nonce( $_GET['_wpnonce'], self::NONCE ) && isset( $_GET['post_id'] ) ) {
			$post_deleted = wp_delete_post( $_GET['post_id'] );
			echo '<h2>123 - ' . $post_deleted . '</h2>';
			if ( ! is_bool( $post_deleted ) ) {
				self::activity_admin_display_message( 'updated', '活动删除成功！' );
			} else {
				self::activity_admin_display_message( 'error', '删除活动失败！' );
			}
		} else {
			self::activity_admin_display_message( 'error', '非法请求！' );
		}
		
		Activity::activity_view( 'activity_admin_list' );
	}
}

?>