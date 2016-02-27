<?php
//remove activity posts from default posts list
function activity_admin_post_filter( $wp_query ) {
  if ( is_admin() ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
      if ( is_plugin_active( 'activity/activity.php' ) ) {
        $activity_cat = intval( get_option( 'activity_category' ) );
        $wp_query -> set( 'cat', -$activity_cat );
      }
    }
  }
}

add_action( 'pre_get_posts', 'activity_admin_post_filter' );

//check if an activity post is added correctly
function activity_admin_post_category_check( $post_id ) {
  if ( is_admin() ) {
    if ( is_plugin_active( 'activity/activity.php' ) ) {
      $post_cat = wp_get_post_categories( $post_id );
      if ( empty( $post_cat ) ) {
        return;
      } else {
        $activity_cat = intval( get_option( 'activity_category' ) );
        $is_post_activity = in_array( $activity_cat, $post_cat );
        if ( $is_post_activity ) {
          /*
           * To be implemented.
           * if there is a record of the same value as $post_id in activity_meta, it is added properly through activity plugin.
           * otherwise, it is added elsewhere and here should delete this post, redirect browser to activity list and display an error message.
           */
        } else {
          return;
        }
      }
    }
  }
}

add_action( 'save_post', 'activity_admin_post_category_check' );
