<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset=utf-8>
<title>Potato个人博客</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="个人博客,Potato个人博客,个人博客模板,Potato" />
<meta name="description" content="Potato个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
<link rel="Shortcut Icon" type="image/x-icon" href="/favicon.ico" />
<link href="/css/base.css" rel="stylesheet">
<link href="/css/index.css" rel="stylesheet">
<link href="/css/info.css" rel="stylesheet">
<link href="/css/m.css" rel="stylesheet">
</script>
</head>
<body>

<meta name="csrf-token" content="{{ csrf_token() }}">

<header class="header-navigation" id="header">
    <nav><div class="logo"><a href="javascript:;">Potato个人博客</a></div>
    <h2 id="mnavh"><span class="navicon"></span></h2>
    <ul id="starlist">
        <li><a href="index.html">网站首页</a></li>
        <li><a href="share.html">我的相册</a></li>
        <li><a href="list.html">我的日记</a></li>
        <li><a href="about.html">关于我</a></li>
        <li><a href="gbook.html">留言</a></li>
        <li><a href="info.html">内容页</a></li>
        <li><a href="infopic.html">内容页</a></li>
    </ul>
    </nav>
</header>

<article>
    <aside class="l_box">
    <div class="search">
        <form action="/e/search/index.php" method="post" name="searchform" id="searchform">
            <input name="keyboard" id="keyboard" class="input_text" value="请输入关键字词" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字词'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字词'}" type="text">
            <input name="show" value="title" type="hidden">
            <input name="tempid" value="1" type="hidden">
            <input name="tbname" value="news" type="hidden">
            <input name="Submit" class="input_submit" value="搜索" type="submit">
        </form>
    </div>
    <div class="fenlei">
        <h2>文章分类</h2>
        <ul>
            <!-- <li><a href="javascript:;">学无止境（33）</a></li> -->
            @foreach ($articletypelists as $articletypelist)
                <li><a href="">{{ $articletypelist->type_name }} ({{ $articletypelist->type_have_count }})</a></li>
            @endforeach
        </ul>
    </div>
    <div class="tuijian">
        <h2>站长推荐</h2>
        <ul>
            <!-- <li><a href="javascript:;">你是什么人便会遇上什么人</a></li> -->
        </ul>
    </div>
    <div class="links">
        <h2>友情链接</h2>
        <ul>
            <a href="javascript:;">Potato个人博客</a> <a href="javascript:;">Potato博客</a>
        </ul>
    </div>
    <div class="guanzhu">
        <h2>关注我 么么哒</h2>
        <ul>
            <img src="/images/wxcode.png">
        </ul>
    </div>
</aside>
<div class="infosbox">
    <div class="newsview">
        <input type="hidden" id="data_article_id" value="{{ $articleinfo->id }}">
        <h3 class="news_title">{{ $articleinfo->name }}</h3>
        <div class="bloginfo">
            <ul>
                <li class="author">作者：<a href="/">{{ $articleinfo->auth }}</a></li>
                <li class="lmname">分类：<a href="/">{{ $articleinfo->type_name }}</a></li>
                <li class="timer">{{ $articleinfo->insert_time }}</li>
                <li class="view"><b id="read_num">{{ $articleinfo->read_num }}</b> 人已阅读</li>
            </ul>
        </div>
        <div class="tags">
            @foreach (explode(',', $articleinfo->tag) as $tag)
                <a href="" target="_blank">{{ $tag }}</a>
            @endforeach
            <!-- <a href="/" target="_blank">tag1</a>
            <a href="/" target="_blank">tag2</a> -->
        </div>
        <div class="news_about">
            <strong>简介</strong>
            {{ $articleinfo->title }}
        </div>
        <div class="news_content">
            {!! $articleinfo->content !!}
        </div>
    </div>
    <div class="share">
        <p class="diggit"><a href="javascript:;"> 很赞哦! </a>(<b id="diggnum">{{ $articleinfo->like_num }}</b>)</p>
    </div>
    <div class="nextinfo">
        <p>上一篇<a href="/news/life/2018-03-13/804.html">啊啊啊啊啊啊</a></p>
        <p>下一篇<a href="/news/life/">踩踩踩踩踩踩</a></p>
    </div>
    <div class="news_pl">
        <h2>评论</h2>
        <ul>
            <div class="gbko"></div>
        </ul>
    </div>
</div>

<footer>
    <p>Design by <a href="javascript:;">Potato个人博客</a> <a href="javascript:;">蜀ICP备11002373号-1</a></p>
</footer>

<a href="javascript:;" class="cd-top">Top</a>

</body>
</html>

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/comm.js" type="text/javascript"></script>
<script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>

<script>
    $(function(){
        var article_id = $("#data_article_id").val()
        var ip = returnCitySN["cip"]
        var address = returnCitySN["cname"]

        if (""!=article_id && ""!=ip) {        
            // 添加阅读人数
            $.ajax({
                type: "post",
                url: "/home/article/read_add",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    article_id: article_id,
                    ip: ip,
                    address: address
                },
                dataType: "json",
                success: function(data) {
                    if (1 == data) {
                        $("#read_num").html(parseInt($("#read_num").html()) + 1)
                    }
                }
            })
        }

        $(".diggit").on("click", function() {
            var article_id = $("#data_article_id").val()
            var ip = returnCitySN["cip"]
            var address = returnCitySN["cname"]

            // 添加阅读人数
            $.ajax({
                type: "post",
                url: "/home/article/like_add",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    article_id: article_id,
                    ip: ip,
                    address: address
                },
                dataType: "json",
                success: function(data) {
                    if (1 == data) {
                        $("#diggnum").html(parseInt($("#diggnum").html()) + 1)
                    }
                }
            })
        })
    })
</script>