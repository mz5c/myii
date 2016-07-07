<div class="aw-top-menu-wrap">
    <div class="container">
        <div class="aw-logo hidden-xs">
            <a href="/user/default/quora"></a>
        </div>
        <div class="aw-search-box  hidden-xs hidden-sm">
            <form class="navbar-search" action="/user/default/index" id="global_search_form" method="post">
                <input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="q" id="aw-search-query">
                <span title="搜索" id="global_search_btns" onclick="$('#global_search_form').submit();"><span class="glyphicon glyphicon-search"></span></span>
                <div class="aw-dropdown">
                    <div class="mod-body">
                        <p class="title">输入关键字进行搜索</p>
                        <ul class="aw-dropdown-list hide"></ul>
                        <p class="search"><span>搜索:</span><a onclick="$('#global_search_form').submit();"></a></p>
                    </div>
                    <div class="mod-footer">
                        <a href="" onclick="$('#header_publish').click();" class="pull-right btn btn-mini btn-success publish">发起问题</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>