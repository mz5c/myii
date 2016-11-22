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
    </div>
</div>
<div style="width: 70%;margin: 0 auto;">
    <a href="/"><img src="/images/desktop.jpg" class="img-responsive img-thumbnail"></a>
</div>
<script>
    function geSearch(){
        var keyword = $('#media_search').val();
        if(keyword != ''){
            window.location.href = '/';
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