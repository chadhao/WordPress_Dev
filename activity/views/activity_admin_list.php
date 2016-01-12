<?php

$activity_args = array(
	'category' => get_option( 'activity_category' ),
	'orderby' => 'date',
	'order' => 'DESC',
);
$all_activity = get_posts( $activity_args );
?>
<div class="wrap">
	<h1>活动列表 <a href="#" class="page-title-action">添加活动</a></h1>
	<table>
		
		<?php
		if ( ! empty( $all_activity ) ) {
			foreach ( $all_activity as $activity ) {
		?>
		<tr>
			<td>ID</td>
			<td>Title</td>
			<td>Last modified</td>
		</tr>
		<?php
				echo '<tr><td>' . $activity -> ID .'</td><td>' . $activity -> post_title . '</td><td>' . $activity -> post_modified . '</td></tr>';
			}
		} else {
			echo '<h2>No activities!</h2>';
		}
		?>
	</table>
</div>