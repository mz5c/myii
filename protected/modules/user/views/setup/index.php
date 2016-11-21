<div class="col-md-10">
    <ul class="breadcrumb">
        <li><h5>修改密码</h5></li>
    </ul>
	<div class="col-md-6 well">
		<form role="form">
			<div class="form-group">
				<label for="origin_pwd">当前密码</label><input type="password" class="form-control" id="origin_pwd" placeholder="输入当前密码">
			</div>
			<div class="form-group">
				<label for="new_pwd">新密码</label><input type="password" class="form-control" id="new_pwd" placeholder="输入新密码">
			</div>
			<div class="form-group">
				<label for="confirm_pwd">确认密码</label><input type="password" class="form-control" id="confirm_pwd" placeholder="再次输入确认密码">
			</div>
			<button type="button" class="btn btn-info" id="save">Confirm</button>
			<button type="button" class="btn btn-default" id="cancel">Cancel</button>
		</form>
	</div>
</div>

<script>
	$(function () {
		$('#save').on('click', function () {
            var origin_pwd = $('#origin_pwd').val();
            var new_pwd = $('#new_pwd').val();
            var confirm_pwd = $('#confirm_pwd').val();
            if(origin_pwd == '' || new_pwd == '' || confirm_pwd == ''){
                layer.msg('invalid params');
            }else{
                $.ajax({
                    url: '/user/setup/setpwd',
                    type: 'post',
                    data: {origin_pwd: origin_pwd, new_pwd: new_pwd, confirm_pwd: confirm_pwd},
                    dataType: 'json',
                    success: function (ret) {
                        if(ret.code == 200){
                            alert('修改成功, 请重新登录');
                            window.location.href = '/user/default/logout';
                        }else{
                            layer.msg(ret.msg);
                        }
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
		});

		$('#cancel').on('click', function () {
			window.history.back();
		});
	});
</script>