<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="/css/bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <script src="/css/bootstrap-3.3.5-dist/jquery-2.1.4.min.js"></script>
    <script src="/css/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="/js/layer-2.2/layer.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Myii</a>
            </div>
            <div>
                <div class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" id="media_search">
                    </div>
                    <button type="button" class="btn btn-default" id="go_search">搜索</button>
                </div>
                <?php if(Yii::app()->user->name == 'Guest'){ ?>
                    <a href="/user/default/register" class="btn btn-default navbar-btn pull-right" style="margin-right: 5px;">注册</a>
                    <a href="/user/default/login" class="btn btn-info navbar-btn pull-right" style="margin-right: 5px;">登录</a>
                <?php }else{
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    ?>
                    <a href="/user/default/logout" class="btn btn-default navbar-btn pull-right" style="margin-right: 5px;">退出</a>
                    <a href="/user/default/gotobackend" class="btn btn-info navbar-btn pull-right" style="margin-right: 5px;"><?php echo empty($user->nick_name) ? $user->user_name : $user->nick_name; ?></a>
                <?php } ?>
            </div>
        </nav>
        <div class="col-md-2">
            <ul class="nav nav-stacked nav-pills well">
                <li data-controller_name="home">
                    <a href="/user/home/index">首页</a>
                </li>
                <li data-controller_name="brief">
                    <a href="/user/brief/index">Brief</a>
                </li>
                <!--<li class="nav-header">
                    功能列表
                </li>-->
                <li data-controller_name="info">
                    <a href="/user/info/index">资料</a>
                </li>
                <li data-controller_name="setup">
                    <a href="/user/setup/index">设置</a>
                </li>
                <li>
                    <a href="#">帮助</a>
                </li>
            </ul>
        </div>

        <?php echo $content; ?>

    </div>
</div>
<script>
    $(function () {
        var arr = window.location.pathname.split('/');
        $("li[data-controller_name='" + arr[2] + "']").addClass('active');
    });
</script>
</body>
</html>
