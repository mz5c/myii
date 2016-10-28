<div class="container">
    <table class="table table-condensed">
        <caption style="text-align: center;font-size: 25px">用户列表</caption>
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
                <td><button class="btn btn-link" data-toggle="modal" data-target="#myModal">修改</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    修改用户信息
                </h4>
            </div>
            <div class="modal-body">
                <div style="width: 60%;margin: 0 auto;">
                    <div class="input-group" style="margin: 2px auto;">
                        <span class="input-group-addon">用户名</span>
                        <input id="user_name" type="text" class="form-control" value="rico">
                    </div>
                    <div class="input-group" style="margin: 2px auto;">
                        <span class="input-group-addon">邮箱</span>
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
<script>
    $(function () {
        /*$('#myModal').on('show.bs.modal', function () {
         alert('1');
         });
         $('#myModal').on('shown.bs.modal', function () {
         alert('2');
         });
         $('#myModal').on('hide.bs.modal', function () {
         alert('3');
         });
         $('#myModal').on('hidden.bs.modal', function () {
         alert('4');
         });*/
    }
</script>