<?php
include 'style.php';

$add_new = $_GET['post_action']=='add'?true:false;
$post_id = $add_new?0:$_GET['post_id'];
$the_post = !$add_new?Activity_Admin::activity_admin_get_post( $post_id ):NULL;
?>

<div class="wrap">
	<form class="am-form" method="post" action="">
		<fieldset>

			<legend><?php echo $add_new?'添加活动':'编辑活动'; ?></legend>

			<input type="hidden" id="post_id" value="<?php echo $add_new?'new':$_GET['post_id']; ?>">

			<div class="am-g-collapse">
				<div class="am-form-group am-g">
					<label for="title">活动标题</label>
					<input type="text" id="title" placeholder="请填写活动标题" value="<?php echo !$add_new?$the_post -> post_title:''; ?>">
				</div>

				<div class="am-form-group am-g">
					<label for="location">活动地点</label>
					<input type="text" id="location" placeholder="请填写活动地点">
				</div>

				<div class="am-form-group am-g">
					<label for="activity_datetime">活动时间</label>
					<div id="activity_datetime">
						<span class="am-u-sm-2" style="padding-left: 0;"><input type="text" id="activity_date" placeholder="请选择活动日期" class="am-form-field" data-am-datepicker readonly></span>
						<select id="activity_time" data-am-selected="{maxHeight: 200}">
							<?php for ( $i=0; $i<144; $i++) { echo '<option value="' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . ':00">' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . '</option>'; } ?>
						</select>
					</div>
				</div>

				<div class="am-form-group  am-g">
					<label for="fee_member">会员收费</label>
					<input type="number" id="fee_member" placeholder="请填写活动费用，免费请留空">
				</div>

				<div class="am-form-group am-g">
					<label for="fee_nonmember">非会员收费</label>
					<input type="number" id="fee_nonmember" placeholder="请填写活动费用，免费请留空">
				</div>

				<div class="am-form-group am-g">
					<label for="signup_datetime">报名截止时间</label>
					<div id="signup_datetime">
						<span class="am-u-sm-2" style="padding-left: 0;"><input type="text" id="signup_date" placeholder="请选择报名截止日期" class="am-form-field" data-am-datepicker readonly></span>
						<select id="signup_time" data-am-selected="{maxHeight: 200}">
							<?php for ( $i=0; $i<144; $i++) { echo '<option value="' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . ':00">' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . '</option>'; } ?>
						</select>
					</div>
				</div>

				<div class="am-form-group am-g">
					<label for="signup_method">报名方式</label>
					<textarea id="signup_method" rows="3" placeholder="请填写报名方式"></textarea>
				</div>

				<div class="am-form-group am-g">
					<label for="poster_upload">活动海报 <a class="am-badge am-badge-secondary am-round" href="<?php echo home_url('/wp-admin/media-new.php'); ?>" target="_blank">上传</a></label>
					<input type="text" id="poster_image" placeholder="请上传活动海报，并填写海报URL">
				</div>

				<div class="am-form-group am-g">
					<label for="activity_detail">活动详情</label>
					<?php
					wp_editor( !$add_new?$the_post -> post_content:'', 'activity_detail' );
					?>
				</div>

				<p style="float: right;"><button type="submit" class="am-btn am-btn-primary am-radius">提交</button></p>
			</div>

		</fieldset>
	</form>
</div>
