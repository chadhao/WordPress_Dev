<?php

class Activity_Signup {

  public static function activity_signup_count( $post_id=0 ) {
    global $wpdb;
    $table_name = $wpdb->prefix . "activity_signup";
    $count = $wpdb -> get_var( "SELECT COUNT(*) FROM $table_name WHERE activity_id = $post_id" );
    return is_null($count)?0:intval($count);
  }

}
?>
