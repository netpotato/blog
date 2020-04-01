@include('home.layouts.header')

<article>
    <aside class="l_box">
    @include('home.layouts.left.search')
    @include('home.layouts.left.articletype')
    @include('home.layouts.left.recommend')
    @include('home.layouts.left.links')
    @include('home.layouts.left.attention')
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
            @foreach ($taglists as $taglist)
                @if (in_array($taglist->id, $article_tags))
                    <a href="/home/tag/article_list?tag_id={{ $taglist->id }}" target="_blank">{{ $taglist->tag_name }}</a>
                @endif
            @endforeach
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
        @if (isset($pre_articleinfo))
            <p>上一篇: <a href="/home/article/detail?article_id={{ $pre_articleinfo->id }}">{{ $pre_articleinfo->name }}</a></p>
        @endif
        @if (isset($next_articleinfo))
            <p>下一篇: <a href="/home/article/detail?article_id={{ $next_articleinfo->id }}">{{ $next_articleinfo->name }}</a></p>
        @endif
    </div>
    <div class="news_pl">
        <h2>评论</h2>
        <ul>
            <div class="gbko"></div>
        </ul>
    </div>
</div>

@include('home.layouts.footer')

<script src="/js/jquery.min.js" type="text/javascript"></script>
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