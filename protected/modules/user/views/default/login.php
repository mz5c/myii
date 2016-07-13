<div class="container" style="position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%,-50%);-moz-transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);-o-transform: translate(-50%,-50%);transform: translate(-50%,-50%);">
    <form id="yyyyy" class="form-horizontal" role="form" action="/user/default/login" method="post">
        <div class="form-group">
            <label for="user_name" class="col-sm-2 col-sm-offset-2 control-label">用户名</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="请输入用户名">
                <p id="errmsg1" style="color: #ee0000;margin: 0;display: none;"></p>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 col-sm-offset-2 control-label">密码</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
                <p id="errmsg2" style="color: #ee0000;margin: 0;display: none;"></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember_me" style="margin-top: 5px"> 请记住我
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="button" id="xxxxx" class="btn btn-default">登录</button>
                <button type="button" class="btn btn-default" onclick="location.href='/'">取消</button>
            </div>
        </div>
    </form>
</div>
<script>
    $('#xxxxx').click(function () {
        if($('#user_name').val() == ''){
            $('#errmsg1').show().html('用户名不能为空！');
        }else if($('#password').val() == ''){
            $('#errmsg2').show().html('密码不能为空！');
        }else{
            $('#yyyyy').submit();
        }
    });
    $('#user_name').change(function () {
        if($('#user_name').val() != ''){
            $('#errmsg1').hide();
        }
    });
    $('#password').change(function () {
        if($('#password').val() != ''){
            $('#errmsg2').hide();
        }
    });
    var errmsg = '<?php echo $errmsg; ?>';
    if(errmsg != ''){
        $('#errmsg2').show().html(errmsg);
    }
</script>