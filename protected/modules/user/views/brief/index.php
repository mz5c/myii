<div class="col-md-10">
	<ul class="breadcrumb">
		<li><a href="/user/brief/add" class="btn btn-info">Add New Brief</a></li>
	</ul>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>编号</th>
			<th>Title</th>
			<th>Content</th>
			<th>状态</th>
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
                <td><?=$val['status']?></td>
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
</div>