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
			} else if ( $_GET['action'] == 'activity_admin_post' ) {
				self::activity_admin_post( $_GET['post_action'] );
			} else if ( $_GET['action'] == 'activity_admin_process_post' ) {
				self::activity_admin_process_post();
			}

		} else {
			self::activity_admin_display_activity();
		}
	}

	public static function activity_admin_get_url( $action, $post_id=0 ) {
		if ( $action == 'activity_admin_delete_post' ) {
			$args = array( 'page' => 'activity_admin', 'action' => $action, 'post_id' => $post_id, '_wpnonce' => wp_create_nonce( self::NONCE ) );
		} else if ( $action == 'activity_admin_add_post' ) {
			$args = array( 'page' => 'activity_admin', 'action' => 'activity_admin_post', 'post_action' => 'add', '_wpnonce' => wp_create_nonce( self::NONCE ) );
		} else if ( $action == 'activity_admin_edit_post' ) {
			$args = array( 'page' => 'activity_admin', 'action' => 'activity_admin_post', 'post_action' => 'edit', 'post_id' => $post_id, '_wpnonce' => wp_create_nonce( self::NONCE ) );
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

	//bugs to be fixed
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

	public static function activity_admin_post( $post_action ) {
		if ( !wp_verify_nonce( $_GET['_wpnonce'], self::NONCE) || ( $post_action != 'add' && $post_action != 'edit' ) ) {
			self::activity_admin_display_message( 'error', '非法请求！' );
			Activity::activity_view( 'activity_admin_list' );
		} else {
			Activity::activity_view( 'activity_admin_post' );
		}
	}

	public static function activity_admin_get_post_meta( $post_id ) {
		global $wpdb;
		$table_name = $wpdb->prefix . "activity_meta";
		$result = $wpdb -> get_row( "SELECT * FROM $table_name WHERE post_id = $post_id" );
		return $result;
	}

	private static function activity_admin_is_field_empty() {
		foreach ( $_POST as $key => $value ) {
			if ( $key == 'poster' || $key == 'fee_member' || $key == 'fee_nonmember' ) {
				continue;
			}
			if ( empty($value) ) {
				return true;
			}
		}
		return false;
	}
	
	private static function activity_admin_process_post_data_array() {
		$data_array = array();
		$is_new  = $_POST['is_new']==1?true:false;
		foreach ( $_POST as $key => $value ) {
			$data_array[$key] = $value;
		}
		unset( $data_array['is_new'] );
		if ( $is_new ) {
			unset( $data_array['post_id'] );
		}
		return $data_array;
	}

	private static function activity_admin_insert_post( $data ) {
		$activity_cat = intval( get_option( 'activity_category' ) );
		$post_data = array(
			'post_content' => $data['activity_detail'],
			'post_name' => $data['title'],
			'post_title' => $data['title'],
			'post_status' => 'publish',
			'ping_status' => 'open',
			'post_category' => array($activity_cat)
		);
		$post_insert = wp_insert_post($post_data );
		if ( $post_insert == 0 ) {
			return false;
		} else {
			global $wpdb;
			$table_name = $wpdb->prefix . "activity_meta";
			$post_meta = array(
				'post_id' => $post_insert,
				'location' => $data['location'],
				
			);
		}
	}

	public static function activity_admin_process_post() {
		if ( self::activity_admin_is_field_empty() ) {
			echo '<script type="text/javascript">alert("除活动海报和收费外，其他项目均为必填！\n请检查表单是否填写完整！"); window.history.back();</script>';
		} else {
			if ( wp_verify_nonce( $_GET['_wpnonce'], self::NONCE) && $_POST['is_new'] == 1 ) {
				if ( self::activity_admin_insert_post( self::activity_admin_process_post_data_array() ) ) {
					self::activity_admin_display_message( 'updated', '活动添加成功！' );
				} else {
					self::activity_admin_display_message( 'error', '活动添加失败！' );
				}
				Activity::activity_view( 'activity_admin_list' );
			} else if ( wp_verify_nonce( $_GET['_wpnonce'], self::NONCE) && $_POST['is_new'] == -1 ) {
				echo '<h2>is not new!</h2>';
			} else {
				self::activity_admin_display_message( 'error', '非法请求！' );
				Activity::activity_view( 'activity_admin_list' );
			}
		}
	}
}

?>
