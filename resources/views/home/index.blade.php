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
<link href="/css/m.css" rel="stylesheet">
</head>
<body>

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
    <div class="about_me">
        <h2>关于我</h2>
        <ul>
            <i><img src="/images/4.jpg"></i>
            <p><b>Potato</b>，JS，PHP，Python，Go。</p>
        </ul>
    </div>
    <!-- <div class="wdxc">
        <h2>我的相册</h2>
        <ul>
            <li><a href="javascript:;"><img src="/images/7.jpg"></a></li>
            <li><a href="javascript:;"><img src="/images/8.jpg"></a></li>
            <li><a href="javascript:;"><img src="/images/9.jpg"></a></li>
            <li><a href="javascript:;"><img src="/images/10.jpg"></a></li>
            <li><a href="javascript:;"><img src="/images/11.jpg"></a></li>
            <li><a href="javascript:;"><img src="/images/12.jpg"></a></li>
        </ul>
    </div> -->
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
<main class="r_box">

<!-- <li><i><a href="/"><img src="images/3.jpg"></a></i>
<h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
<p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
</li> -->
    @foreach ($articles as $article)
        <li>
            <i><a href=""><img src="{{ $article->path }}"></a></i>
            <h3><a href="/home/article/detail?article_id={{ $article->id }}">{{ $article->name }}</a></h3>
            <p>{{ $article->title }}</p>
            <div style="font-size: 12px;display: flex;flex-direction: row;">
                <p>分类 · {{ $article->type_name }}</p>
                <p style="margin-left: 26px;">作者 · {{ $article->auth }}</p>
                <p style="margin-left: 16px;">阅读数：{{ $article->pv }}</p>
                <p style="margin-left: 26px;">发布时间：{{ $article->insert_time }}</p>
            </div>
        </li>
    @endforeach
</main>
</article>

<footer>
    <p>Design by <a href="javascript:;">Potato个人博客</a> <a href="javascript:;">蜀ICP备11002373号-1</a></p>
</footer>

<a href="javascript:;" class="cd-top">Top</a>

</body>
</html>

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/comm.js" type="text/javascript"></script>
