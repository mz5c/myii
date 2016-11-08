<div class="col-md-10">
    <div class="col-md-6 well">
        <form role="form">
            <div class="form-group">
                <label for="brief_bid">编号</label><input type="text" class="form-control" id="brief_bid" value="<?=$info->bid?>" readonly>
            </div>
            <div class="form-group">
                <label for="brief_title">Title</label><input type="text" class="form-control" id="brief_title" value="<?=$info->title?>">
            </div>
            <div class="form-group">
                <label for="brief_content">Content</label><textarea class="form-control" id="brief_content"><?=$info->content?></textarea>
            </div>
            <div class="form-group">
                <label for="brief_create_time">创建时间</label><input type="text" class="form-control" id="brief_create_time" value="<?=$info->create_time?>" readonly>
            </div>
            <div class="form-group">
                <label for="brief_modify_time">更新时间</label><input type="text" class="form-control" id="brief_modify_time" value="<?=$info->modify_time?>" readonly>
            </div>
            <button type="button" class="btn btn-info" id="brief_save">Save</button>
            <button type="button" class="btn btn-default" id="brief_cancel">Cancel</button>
        </form>
    </div>
</div>

<script>
    $(function () {
        var origin_title = '<?=$info->title?>';
        var origin_content = '<?=$info->content?>';
        $('#brief_save').on('click', function () {
            if($('#brief_title').val() != origin_title || $('#brief_content').val() != origin_content){
                $.ajax({
                    url: '/user/brief/edit',
                    type: 'post',
                    data: {bid: $('#brief_bid').val(), title: $('#brief_title').val(), content: $('#brief_content').val()},
                    dataType: 'json',
                    success: function (res) {
                        if(res.code == 200){
                            window.location.href = '/user/brief/detail?bid=' + $('#brief_bid').val();
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

        $('#brief_cancel').on('click', function () {
            window.history.back();
        });
    });
</script>