<?php
include 'style.php';

$post_id = isset($_GET['post_id'])?$_GET['post_id']:0;

$list = Activity_Signup::activity_signup_get_list( $post_id );
?>

<div class="wrap">
  <h1><?php echo $post_id==0?'No Activity':get_the_title($post_id); ?> <a href="<?php echo esc_url( Activity_Admin::activity_admin_get_url( 'activity_admin_add_post' ) ); ?>" class="page-title-action">add participator</a></h1>
  <table class="am-table am-table-hover">
    <?php
      if($post_id != 0){
     ?>
     <tr>
       <td>ID</td>
       <td>name</td>
       <td>email</td>
       <td>phone</td>
       <td>fee_paid</td>
       <td>is_aut_student</td>
       <td>is_autcsa_member</td>
       <td>time</td>
     </tr>
     <?php
       $ID = 1;
       foreach ( $list as $piece ) {
         echo '<tr>' .
             '<td>' . $ID++ .'</td>' .
             '<td>' . $piece -> name . '</td>' .
             '<td>' . $piece -> email . '</td>' .
             '<td>' . $piece -> phone . '</td>' .
             '<td>' . $piece -> fee_paid . '</td>' .
             '<td>' . $piece -> is_aut_student . '</td>' .
             '<td>' . $piece -> is_autcsa_member . '</td>' .

             '<td><a href="' . esc_url( Activity_Admin::activity_admin_get_url( 'activity_admin_edit_post', $activity -> ID ) ) . '">编辑</a> | <a href="' . esc_url( Activity_Admin::activity_admin_get_url( 'activity_admin_delete_post', $activity -> ID ) ) . '">删除</a></td>' .

            '</tr>';
       }
     } else {
      echo '<h2>No Results！</h2>';
    }
    ?>
  </table>
</div>
