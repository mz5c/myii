<div class="container" style="position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%,-50%);-moz-transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);-o-transform: translate(-50%,-50%);transform: translate(-50%,-50%);">
    <h1 class="text-center">用户注册</h1>
    <form class="form-horizontal" style="border: 1px solid #aeaefe;width: 50%;margin: 0 auto;padding: 30px;" role="form">
        <div class="form-group">
            <label for="user_name" class="col-sm-2 col-sm-offset-2 control-label">用户名</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="请输入用户名">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 col-sm-offset-2 control-label">密码</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
            <label for="repassword" class="col-sm-3 col-sm-offset-1 control-label">重复输入密码</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="请再次输入密码">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="button" id="user_register" class="btn btn-default">注册</button>
                <button type="button" class="btn btn-default" onclick="location.href='/'">取消</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        $('#user_register').on('click', function () {
            var user_name = $('#user_name').val();
            var password = $('#password').val();
            var repassword = $('#repassword').val();
            if (user_name == '' || password == '' || repassword == '' || password != repassword) {
                layer.msg('invalid param');
                return;
            }
            $.ajax({
                url: '/user/default/register',
                type: 'post',
                data: {user_name: user_name, password: password},
                dataType: 'json',
                success: function (res) {
                    if (res.code == 200) {
                        window.location.href = '/';
                    } else {
                        layer.msg(res.msg);
                    }
                },
                error: function () {
                    console.log('error')
                }
            });
        });
    });
</script>