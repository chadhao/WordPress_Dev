<?php
include 'style.php';
?>

<div class="wrap">
	<form class="am-form am-u-sm-6" action="">
		<fieldset>
			<legend><?php echo $_GET['post_action']=='add'?'添加活动':'编辑活动'; ?></legend>
			
			<input type="hidden" id="post_id" value="<?php echo $_GET['post_action']=='add'?'new':$_GET['post_id']; ?>">
			
			<div class="am-form-group am-g">
				<label for="title">活动标题</label>
				<input type="text" id="title" placeholder="请输入活动标题">
			</div>

			<div class="am-form-group am-g">
				<label for="location">活动地点</label>
				<input type="text" id="location" placeholder="请输入活动地点">
			</div>

			<div class="am-form-group am-g">
				<label for="activity_datetime">活动时间</label>
				<div id="activity_datetime">
					<span class="am-u-sm-6" style="padding-left: 0;"><input type="text" id="activity_date" placeholder="请选择活动日期" class="am-form-field" data-am-datepicker readonly></span>
					<select id="activity_time" data-am-selected="{maxHeight: 200}">
						<?php for ( $i=0; $i<144; $i++) { echo '<option value="' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . ':00">' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . '</option>'; } ?>
					</select>
				</div>
			</div>
			
			<div class="am-form-group  am-g">
				<label for="fee_member">会员收费</label>
				<input type="number" id="fee_member" placeholder="请输入活动费用，免费请留空">
			</div>
			
			<div class="am-form-group am-g">
				<label for="fee_nonmember">非会员收费</label>
				<input type="number" id="fee_nonmember" placeholder="请输入活动费用，免费请留空">
			</div>
			
			<div class="am-form-group am-g">
				<label for="signup_datetime">报名截止时间</label>
				<div id="signup_datetime">
					<span class="am-u-sm-6" style="padding-left: 0;"><input type="text" id="signup_date" placeholder="请选择报名截止日期" class="am-form-field" data-am-datepicker readonly></span>
					<select id="signup_time" data-am-selected="{maxHeight: 200}">
						<?php for ( $i=0; $i<144; $i++) { echo '<option value="' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . ':00">' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . '</option>'; } ?>
					</select>
				</div>
			</div>
			
			<div class="am-form-group am-g">
				<label for="signup_method">报名方式</label>
				<textarea id="signup_method" rows="3"></textarea>
			</div>
			
			<div class="am-form-group am-g">
				<label for="poster">活动海报</label>
				<input type="submit"><input type="file" name="poster">
			</div>
			
		</fieldset>
	</form>
</div>