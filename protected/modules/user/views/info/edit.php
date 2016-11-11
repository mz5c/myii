<div class="col-md-10">
    <div class="col-md-6 well">
        <form role="form">
            <div class="form-group">
                <label for="user_name">用户名</label><input type="text" class="form-control" id="user_name" value="<?=$user->user_name?>" readonly>
            </div>
            <div class="form-group">
                <label for="nick_name">呢称</label><input type="text" class="form-control" id="nick_name" value="<?=$user->nick_name?>">
            </div>
            <div class="form-group">
                <label for="user_sex">性别</label>
                <select class="form-control" id="user_sex">
                    <option value="0" <?=$user->sex == 0 ? 'selected' : ''?>>未知</option>
                    <option value="1" <?=$user->sex == 1 ? 'selected' : ''?>>男</option>
                    <option value="2" <?=$user->sex == 2 ? 'selected' : ''?>>女</option>
                </select>
            </div>
            <div class="form-group">
                <label for="user_email">Email</label><input type="text" class="form-control" id="user_email" value="<?=$user->email?>">
            </div>
            <button type="button" class="btn btn-info" id="save">Save</button>
            <button type="button" class="btn btn-default" id="cancel">Cancel</button>
        </form>
    </div>
</div>

<script>
    $(function () {
        $('#save').on('click', function () {
            $user_sex = $('#user_sex').val();
            $user_email = $('#user_email').val();
            $nick_name = $('#nick_name').val();
            if($user_sex != '<?=$user->sex?>' || $user_email != '<?=$user->email?>' || $nick_name != '<?=$user->nick_name?>'){
                $.ajax({
                    url: '/user/info/edit',
                    type: 'post',
                    data: {user_sex: $user_sex, user_email: $user_email, nick_name: $nick_name},
                    dataType: 'json',
                    success: function (res) {
                        if(res.code == 200){
                            window.location.href = '/user/info/index';
                        }else{
                            layer.msg(res.msg);
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