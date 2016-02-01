<?php
include 'style.php';
?>

<div class="wrap">
	<form class="am-form am-u-sm-6" action="">
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

			<div class="am-form-group am-u-sm-8">
				<label for="activity_date">活动日期</label>
				<input type="text" id="activity_date" placeholder="请选择活动日期" class="am-form-field" data-am-datepicker readonly>
			</div>
			
			<div class="am-form-group  am-u-sm-4">
				<label for="activity_time">活动时间</label>
				<select id="activity_time">
						<?php for ( $i=0; $i<144; $i++) { echo '<option value="' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . '">' . sprintf("%02d", floor($i/6)) . ':' . sprintf("%02d", floor($i%6*10)) . '</option>'; } ?>
				</select>
			</div>
		</fieldset>
	</form>
</div>