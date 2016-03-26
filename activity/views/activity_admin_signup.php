<?php
include 'style.php';

$add_new = $_GET['signup_action']=='add'?true:false;
$post_id = $add_new?0:intval($_GET['post_id']);

?>

<div class="warp">
    <form class="am-form" method="POST" action="<?php echo esc_url( Activity_Admin::activity_admin_get_url( 'activity_admin_process_signup' ) );?>">
	
    </form>
</div>