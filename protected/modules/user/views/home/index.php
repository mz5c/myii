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
    <?php if (empty($items)) { ?>
        <div class="alert alert-dismissable alert-info">
<!--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
            <h4>
                注意!
            </h4> <strong>Warning!</strong> There is nothing. You can <a href="/user/brief/add" class="alert-link">add new brief</a>
        </div>
    <?php } ?>
</div>
