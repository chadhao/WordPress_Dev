<?php
include 'style.php';
?>

<div class="wrap">
	<h1><?php echo $_GET['post_action']=='add'?'添加活动':'编辑活动'; ?></h1>
	
	
	<h1></h1>
	
	<form class="am-form am-form-horizontal" action="">
		<fieldset>
			<input type="hidden" id="post_id" value="<?php echo $_GET['post_action']=='add'?'new':$_GET['post_id']; ?>">
			
			<div class="am-form-group">
				<label for="title" class="am-u-sm-2 am-form-label">活动标题</label>
				<div class="am-u-sm-10">
					<input type="text" id="title" placeholder="请输入活动标题">
				</div>
			</div>

			<div class="am-form-group">
				<label for="location" class="am-u-sm-2 am-form-label">活动地点</label>
				<div class="am-u-sm-10">
					<input type="text" id="location" placeholder="请输入活动地点">
				</div>
			</div>

			<div class="am-form-group">
				<label for="activity_time" class="am-u-sm-2 am-form-label">活动时间</label>
				<div class="am-u-sm-10">
					<input type="datetime-local" id="activity_time" placeholder="请选择活动时间">
				</div>
			</div>
		</fieldset>
	</form>
</div>