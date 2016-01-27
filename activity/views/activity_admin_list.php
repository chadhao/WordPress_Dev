<?php
include 'style.php';

$activity_args = array(
	'posts_per_page' => -1,
	'category' => get_option( 'activity_category' ),
	'orderby' => 'date',
	'order' => 'DESC'
);
$all_activity = get_posts( $activity_args );
?>
<div class="wrap">
	<h1>活动列表 <a href="#" class="page-title-action">添加活动</a></h1>
	<table class="am-table am-table-hover">
		
		<?php
		if ( ! empty( $all_activity ) ) {
		?>
		<tr>
			<td>ID</td>
			<td>标题</td>
			<td>最后修改</td>
			<td>修改</td>
			<td>删除</td>
		</tr>
		<?php
			foreach ( $all_activity as $activity ) {
				echo '<tr>' .
						'<td>' . $activity -> ID .'</td>' .
						'<td>' . $activity -> post_title . '</td>' .
						'<td>' . $activity -> post_modified . '</td>' .
						'<td>' . '</td>' .
						'<td><a href="' . esc_url( Activity_Admin::activity_admin_get_url( 'activity_admin_delete_post', $activity -> ID ) ) . '">删除</a></td>' .
					 '</tr>';
			}
		} else {
			echo '<h2>没有活动！</h2>';
		}
		?>
	</table>
</div>