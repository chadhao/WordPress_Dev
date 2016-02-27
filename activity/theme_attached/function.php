<?php
function activity_admin_post_filter( $wp_query ) {
  if ( is_admin() ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
      $activity_cat = get_option( 'activity_category' );
      if ( ! $activity_cat ) {
        return;
      }
      $wp_query -> set( 'cat', -intval( $activity_cat ) );
    }
  }
}

add_filter('pre_get_posts', 'activity_admin_post_filter' );
