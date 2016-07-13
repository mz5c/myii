<div class="container">
    <table class="table table-condensed">
        <caption style="text-align: center;">用户列表</caption>
        <thead>
        <tr>
            <th>用户名</th>
            <th>邮箱</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $val){ ?>
            <tr>
                <td><?php echo $val['user_name']; ?></td>
                <td id="ue_<?php echo $val['id']; ?>"><?php echo $val['email']; ?></td>
                <td><?php echo $val['create_time']; ?></td>
                <td><button class="btn btn-link" data-toggle="modal" data-target="#myModal2">修改</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <h2>创建模态框（Modal）</h2>
    <!-- 按钮触发模态框 -->
    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        开始演示模态框
    </button>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        提示信息
                    </h4>
                </div>
                <div id="errmsg" class="modal-body">
                    信息
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">
                        修改用户信息
                    </h4>
                </div>
                <div class="modal-body">
                    <div style="width: 60%;margin: 0 auto;">
                        <div class="input-group" style="margin: 2px auto;">
                            <span class="input-group-addon">用户名</span>
                            <input id="user_name" type="text" class="form-control" value="rico" disabled>
                        </div>
                        <div class="input-group" style="margin: 2px auto;">
                            <span class="input-group-addon">邮&nbsp;&nbsp;&nbsp;箱</span>
                            <input id="email" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button id="modify_user_info" type="button" class="btn btn-primary">
                        确定
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
</div>
<input type="hidden" id="m_id">
<script>
    $(function () {
        $('#myModal').on('show.bs.modal', function () {
            //alert('1');
        });
        $('#myModal').on('shown.bs.modal', function () {
            //alert('2');
        });
        $('#myModal').on('hide.bs.modal', function () {
            //alert('3');
        });
        $('#myModal').on('hidden.bs.modal', function () {
            //alert('4');
        });
        $('.btn.btn-link').click(function () {
            var user_name = $(this).parent().siblings().eq(0).html();
            var email = $(this).parent().siblings().eq(1).html();
            var m_id = $(this).parent().siblings().eq(1).attr('id');
            $('#user_name').val(user_name);
            $('#email').val(email);
            $('#m_id').val(m_id);
        });
        $('#modify_user_info').click(function () {
            if($('#user_name').val() == '' || $('#email').val() == ''){
                alert('参数不能为空');
                return false;
            }
            $.ajax({
                url:'/user/default/modifyuserinfo',
                type:'post',
                data:{user_name:$('#user_name').val(),email:$('#email').val()},
                dataType:'json',
                success: function (res) {
                    if(res.status){
                        $('#'+$('#m_id').val()).html($('#email').val());
                    }
                    $('#errmsg').html(res.info);
                    $('#myModal').modal('show');
                },
                error: function () {
                    alert('call ajax failed!');
                }
            });
            $('#myModal2').modal('hide');
        });
    })
</script>