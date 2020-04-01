@include('home.layouts.header')

<article>
    <aside class="l_box">
        @include('home.layouts.left.search')
        @include('home.layouts.left.articletype')
        @include('home.layouts.left.recommend')
        @include('home.layouts.left.tags')
        @include('home.layouts.left.attention')
    </aside>
<main class="r_box">
    @foreach ($articles as $article)
        <li>
            <i><a href=""><img src="{{ $article->path }}"></a></i>
            <h3><a href="/home/article/detail?article_id={{ $article->id }}">{{ $article->name }}</a></h3>
            <p>{{ $article->title }}</p>
            <div style="font-size: 12px;display: flex;flex-direction: row;">
                <p>分类 · {{ $article->type_name }}</p>
                <p style="margin-left: 26px;">作者 · {{ $article->auth }}</p>
                <p style="margin-left: 16px;">阅读数 · {{ $article->pv }}</p>
                <p style="margin-left: 26px;">发布时间 · {{ $article->insert_time }}</p>
            </div>
        </li>
    @endforeach
</main>
    <div class="home-main-paging">
        {{ $articles->appends(['tag_id'=>$tag_id])->links() }}
    </div>
</article>

@include('home.layouts.footer')
