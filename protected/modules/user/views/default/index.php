<div class="container">
    <img src="/images/desktop.jpg" class="img-responsive img-thumbnail">
    <div class="row" style="margin-top: 10px;">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Hi Rico</a>
            </div>
            <div>
                <div class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" id="media_search">
                    </div>
                    <button type="button" class="btn btn-default" id="go_search">提交按钮</button>
                </div>
                <a href="/user/default/quora" class="btn btn-default navbar-btn">Quora</a>
                <?php if(empty(Yii::app()->user->id)){ ?>
                    <a href="javascript:;" class="btn btn-default navbar-btn pull-right" style="margin-right: 5px;">注册</a>
                    <a href="/user/default/login" class="btn btn-info navbar-btn pull-right" style="margin-right: 5px;">登录</a>
                <?php }else{ ?>
                    <a href="/user/default/logout" class="btn btn-default navbar-btn pull-right" style="margin-right: 5px;">退出</a>
                    <a href="/user/default/userdetail" class="btn btn-info navbar-btn pull-right" style="margin-right: 5px;"><?php echo Yii::app()->user->id; ?></a>
                <?php } ?>
            </div>
        </nav>
        <div class="col-sm-3">1</div>
        <div class="col-sm-3">2</div>
        <div class="col-sm-3">3</div>
        <div class="col-sm-3">4</div>
    </div>
</div>
<script>
    function geSearch(){
        var keyword = $('#media_search').val();
        if(keyword != ''){
            window.location.href = 'http://www.baidu.com';
        }
    }
    $('#media_search').bind('keypress',function(event){
        if(event.keyCode == "13"){
            geSearch();
        }
    });
    $("#go_search").click(function(){
        geSearch();
    });
</script>