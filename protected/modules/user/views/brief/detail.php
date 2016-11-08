<div class="col-md-10">
    <div class="col-md-6 well">
        <form role="form">
            <div class="form-group">
                <label for="brief_bid">编号</label><input type="text" class="form-control" id="brief_bid" value="<?=$info->bid?>" readonly>
            </div>
            <div class="form-group">
                <label for="brief_title">Title</label><input type="text" class="form-control" id="brief_title" value="<?=$info->title?>" readonly>
            </div>
            <div class="form-group">
                <label for="brief_content">Content</label><textarea class="form-control" id="brief_content" readonly><?=$info->content?></textarea>
            </div>
            <div class="form-group">
                <label for="brief_create_time">创建时间</label><input type="text" class="form-control" id="brief_create_time" value="<?=$info->create_time?>" readonly>
            </div>
            <div class="form-group">
                <label for="brief_modify_time">更新时间</label><input type="text" class="form-control" id="brief_modify_time" value="<?=$info->modify_time?>" readonly>
            </div>
            <button type="button" class="btn btn-info" id="brief_edit">Edit</button>
            <button type="button" class="btn btn-default" id="brief_cancel">Cancel</button>
        </form>
    </div>
</div>

<script>
    $(function () {
        $('#brief_edit').on('click', function () {
            window.location.href = '/user/brief/edit?bid=<?=$info->bid?>';
        });

        $('#brief_cancel').on('click', function () {
            window.history.back();
        });
    });
</script>