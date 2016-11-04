<div class="col-md-10">
	<ul class="breadcrumb">
		<li><a href="/user/brief/add" class="btn btn-info">Add New Brief</a></li>
	</ul>
	<table class="table table-hover table-bordered">
		<thead>
		<tr>
			<th>编号</th>
			<th>Title</th>
			<th>Content</th>
			<th>操作</th>
		</tr>
		</thead>
        <tbody>
        <?php
            $color = array('', 'success', 'info');
            $page_length = 10;
            $now_range = ceil($page / $page_length);
            $page_start = ($now_range - 1) * $page_length + 1;
            $page_end = min($total_page, $now_range * $page_length);
        ?>
        <?php foreach ($items as $key => $val) { ?>
            <tr class="<?=$color[$key%3]?>">
                <td><?=$val['bid']?></td>
                <td><?=$val['title']?></td>
                <td><?=$val['content']?></td>
                <td><a href="javascript:;" onclick="deleteBrief(<?=$val['bid']?>)">xxx</a></td>
            </tr>
        <?php } ?>
		</tbody>
	</table>
    <div>
        <ul class="pagination">
            <?php if ($page_start > 1) { ?>
                <li><a href="#">Prev</a></li>
            <?php } ?>
            <?php for ($i = $page_start; $i <= $page_end; $i++) {
                $selected = $i == $page ? 'background: #eeeeee' : '';
                ?>
                <li><a style="<?=$selected?>" href="<?=$page_baseUrl . '?page=' . $i?>"><?=$i?></a></li>
            <?php } ?>
            <?php if ($total_page > $page_end) { ?>
                <li><a href="#">Next</a></li>
            <?php } ?>
        </ul>
    </div>
    <?php if (empty($items)) { ?>
        <div class="alert alert-dismissable alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>
                注意!
            </h4> <strong>Warning!</strong> There is nothing. You can <a href="/user/brief/add" class="alert-link">add new brief</a>
        </div>
    <? } ?>
</div>

<script>
    function deleteBrief(bid){
        $.ajax({
            url: '/user/brief/delete',
            type: 'post',
            data: {bid: bid},
            dataType: 'json',
            success: function (res) {
                if(res.code == 200){
                    window.location.reload();
                }else{
                    layer.msg(res.msg);
                }
            },
            error: function () {
                console.log('error');
            }
        });
    }
</script>