<div class="col-md-10">
    <?php $color = array('', 'success', 'info'); ?>
    <?php foreach ($items as $key => $val) { ?>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?=$val['title']?>
                    </h3>
                </div>
                <div class="panel-body">
                    <?=$val['content']?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>