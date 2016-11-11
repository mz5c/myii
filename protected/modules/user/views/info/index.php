<div class="col-md-10">
	<div class="col-md-6 well">
		<form role="form">
			<div class="form-group">
				<label for="user_name">用户名</label><input type="text" class="form-control" id="user_name" value="<?=$user->user_name?>" readonly>
			</div>
            <div class="form-group">
                <label for="nick_name">呢称</label><input type="text" class="form-control" id="nick_name" value="<?=$user->nick_name?>" readonly>
            </div>
			<div class="form-group">
				<label for="user_sex">性别</label><input type="text" class="form-control" id="user_sex" value="<?=$user->sex == 0 ? '未知' : ($user->sex == 1 ? '男' : '女')?>" readonly>
			</div>
			<div class="form-group">
				<label for="user_email">Email</label><input type="text" class="form-control" id="user_email" value="<?=$user->email?>" readonly>
			</div>
			<div class="form-group">
				<label for="brief_create_time">创建时间</label><input type="text" class="form-control" id="brief_create_time" value="<?=$user->create_time?>" readonly>
			</div>
			<button type="button" class="btn btn-info" id="edit">Edit</button>
			<button type="button" class="btn btn-default" id="cancel">Cancel</button>
		</form>
	</div>
</div>

<script>
	$(function () {
		$('#edit').on('click', function () {
            window.location.href = '/user/info/edit';
		});

		$('#cancel').on('click', function () {
			window.history.back();
		});
	});
</script>