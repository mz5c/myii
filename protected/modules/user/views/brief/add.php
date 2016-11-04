<div class="col-md-10">
	<div class="col-md-6 well">
        <form role="form">
            <div class="form-group">
                <label for="brief_title">Title</label><input type="text" class="form-control" id="brief_title" />
            </div>
            <div class="form-group">
                <label for="brief_content">Content</label><textarea class="form-control" id="brief_content"></textarea>
            </div>
            <button type="button" class="btn btn-info" id="brief_add">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>
</div>
<script>
    $(function () {
        $('#brief_add').on('click', function () {
            var title = $('#brief_title').val();
            var content = $('#brief_content').val();
            if(title == '' || content == ''){
                layer.msg('param is null');
                return;
            }
            $.ajax({
                url: '/user/brief/add',
                type: 'post',
                data: {title: title, content: content},
                dataType: 'json',
                success: function (res) {
                    if(res.code == 200){
                        window.location.href = '/user/brief/index';
                    }else{
                        layer.msg(res.msg);
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        });
    });
</script>