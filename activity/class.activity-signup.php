<?php

class Activity_Signup {

    public static function activity_signup_count( $post_id=0 ) {
        if ( $post_id == 0 ) {
            return 0;
        }
        global $wpdb;
        $table_name = $wpdb->prefix . "activity_signup";
        $count = $wpdb -> get_var( "SELECT COUNT(*) FROM $table_name WHERE activity_id = $post_id" );
        return is_null($count)?0:intval($count);
    }

    public static function activity_signup_get_list( $post_id=0 ) {
        if ( $post_id == 0 ) {
            return 0;
        }
        global $wpdb;
        $table_name = $wpdb->prefix . "activity_signup";
        $signup_list = $wpdb->get_results("SELECT * FROM $table_name WHERE activity_id = $post_id");
        return $signup_list;
    }
    
    public static function activity_signup_delete() {
        if ( ! isset( $_GET['signup_id'] ) || $_GET['signup_id'] == 0 ) {
	    return 0;
	}
	$signup_id = intval( $_GET['signup_id'] );
	global $wpdb;
	$table_name = $wpdb->prefix . "activity_signup";
	if ( $wpdb -> get_var( "SELECT activity_id FROM $table_name WHERE id = $signup_id" ) == $_GET['post_id'] ) {
	    if ( $wpdb -> delete ( $table_name, array( 'id' => $signup_id ) ) ) {
		Activity_Admin::activity_admin_display_message( 'updated', '报名删除成功！' );
	    } else {
		Activity_Admin::activity_admin_display_message( 'error', '报名删除失败！' );
	    }
	} else {
	    Activity_Admin::activity_admin_display_message( 'error', '非法请求！' );
	}
	Activity::activity_view( 'activity_admin_signup_list' );
    }
    
    public static function activity_signup_edit() {
        
    }
    
    public static function activity_signup_add() {
	
    }

}
?>
