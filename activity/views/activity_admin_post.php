<?php
include 'style.php';
?>

<div class="wrap">
	<form class="am-form" action="">
		<fieldset>
			<legend><?php echo $_GET['post_action']=='add'?'添加活动':'编辑活动'; ?></legend>
			
			<input type="hidden" id="post_id" value="<?php echo $_GET['post_action']=='add'?'new':$_GET['post_id']; ?>">
			
			<div class="am-form-group">
				<label for="title">活动标题</label>
				<input type="text" id="title" placeholder="请输入活动标题">
			</div>

			<div class="am-form-group">
				<label for="location">活动地点</label>
				<input type="text" id="location" placeholder="请输入活动地点">
			</div>

			<div class="am-form-group">
				<label for="activity_date">活动日期</label>
				<input type="text" id="activity_date" placeholder="请选择活动日期" class="am-form-field" data-am-datepicker readonly>
			</div>
			
			<div class="am-form-group">
				<label for="activity_time_hour">活动时间</label>
				<select id="activity_time_hour">
						<?php for ( $i=0; $i<24; $i++) { echo '<option value="' . $i . '">' . $i . '</option>'; } ?>
				</select>
			</div>
		</fieldset>
	</form>
</div>