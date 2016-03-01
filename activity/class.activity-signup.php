<?php

class Activity_Signup {

  public static function activity_signup_count( $post_id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . "activity_meta";
    $query = "SELECT COUNT(*) FROM $table_name WHERE activity_id = $post_id";
    $count = $wpdb -> get_var( $query );
    return is_null($count)?0:intval($count);
  }

}
