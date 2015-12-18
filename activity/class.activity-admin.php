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
		add_submenu_page( 'activity_admin', '活动设置', '活动设置', 'edit_posts', 'activity_admin_setting', array( 'Activity_Admin', 'activity_admin_display_setting' ) );
	}
	
	public static function activity_admin_page() {
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'activity_admin_setting_modify' )
		{
			self::activity_admin_setting_modify();
		} else {
			self::activity_admin_display_activity();
		}
	}
	
	public static function activity_admin_get_url( $action ) {
		$args = array( 'page' => 'activity_admin', 'action' => $action, '_wpnonce' => wp_create_nonce( self::NONCE ) );
		$url = add_query_arg( $args, admin_url( 'admin.php' ) );
		return $url;
	}
	
	public static function activity_admin_setting_modify() {
		echo '<h1>here i am in activity_admin_setting_modify</h1>';
		echo '<h1>' . wp_verify_nonce( $_GET['_wpnonce'], self::NONCE ) . '</h1>';
	}
	
	public static function activity_admin_display_activity() {
		echo '
			<div class="wrap">
			<h1>activity list</h1>
			</div>
		';
	}
	
	public static function activity_admin_display_setting() {
		$all_terms = get_terms( 'category', 'orderby=id&hide_empty=0' );
		$current_category = get_option( 'activity_category' );
		echo '
			<div class="wrap">
			<h1>Activity Settings</h1>
			<form name="activity_admin_setting" id="activity_admin_setting" method="post" action="' . esc_url( Activity_Admin::activity_admin_get_url( 'activity_admin_setting_modify' ) ) . '">
				
			<table class="form-table">
			<tr>
			<th scope="row"><label for="activity_category">活动分类</label></th>
			<td>
			<select name="activity_category" id="activity_category">';
			foreach ( $all_terms as $term ) {
				echo '<option value="' . $term->name . '"';
				if ( $term->term_id == $current_category )
				{
					echo ' selected="selected">';
				} else {
					echo '>';
				}
				echo $term->name . '</option>';
			}
			echo '</select>
			<p class="description" id="activity_category-description">请选择一个分类作为活动分类。</p>
			</td>
			</tr>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存"  /></p>

			</form>
			</div>
		';
	}
	
	public static function activity_admin_change_activity_category() {
		
	}
}

?>