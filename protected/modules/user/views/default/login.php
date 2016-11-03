<div class="container" style="position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%,-50%);-moz-transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);-o-transform: translate(-50%,-50%);transform: translate(-50%,-50%);">
    <h1 class="text-center">用户登录</h1>
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
            <div class="col-sm-offset-4 col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="remember_me" name="remember_me" style="margin-top: 5px"> 请记住我
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="button" id="user_login" class="btn btn-default">登录</button>
                <button type="button" class="btn btn-default" onclick="location.href='/'">取消</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        function login(){
            var user_name = $('#user_name').val();
            var password = $('#password').val();
            var remember_me = $('#remember_me').prop('checked') == true ? 1 : 0;
            if(user_name == '' || password == ''){
                layer.msg('exists empty param !');
                return;
            }
            $.ajax({
                url: '/user/default/login',
                type: 'post',
                data: {user_name: user_name, password: password, remember_me: remember_me},
                dataType: 'json',
                success: function (res) {
                    if(res.code == 200){
                        window.location.href = '/';
                    }else{
                        layer.msg(res.msg);
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        };

        $('#user_login').on('click', function () {
            login();
        });

        $('#password').bind('keypress', function (event) {
            if(event.keyCode == '13'){
                login();
            }
        });
    });
</script>