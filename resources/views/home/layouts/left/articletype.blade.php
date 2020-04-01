<!-- 文章分类 -->
<div class="articletype">
    <h2>文章分类</h2>
    <ul>
        <!-- <li><a href="javascript:;">学无止境（33）</a></li> -->
        @foreach ($articletypelists as $articletypelist)
            <li><a href="/home/articletype/article_list?articletype_id={{ $articletypelist->articletype_id }}">{{ $articletypelist->type_name }} ({{ $articletypelist->type_have_count }})</a></li>
        @endforeach
    </ul>
</div>