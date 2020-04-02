<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller {

    // 类型文章列表页面
    public function article_list(Request $request) {
        $tag_id = $request->get('tag_id');
        $articletypelists = DB::table('article')
                                ->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
                                ->select(DB::raw('articletype_id, count(*) as type_have_count, type_name'))
                                ->groupBy('article.articletype_id')
                                ->get();
        $articles = DB::table('article')
                        ->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
                        ->leftjoin('image', function($join){ $join->on('article.image_id', '=', 'image.id'); })
                        ->leftjoin('tag', function($join){ $join->whereRaw(\DB::raw('FIND_IN_SET(blog_tag.id, blog_article.tags)')); })
                        ->select('article.id', 'article.name', 'article.auth', 'article.title', 'article.image_id', 'article.insert_time', 'article.pv', 'articletype.type_name', 'image.path')
                        ->where('tag.id', '=', $tag_id)
                        ->orderByDesc('article.id')
                        ->paginate(5);
        $tags = DB::table('tag')
                        ->select('id', 'tag_name')
                        ->get();
        return view('home.tag.article_list', [
                'tag_id' => $tag_id,
                'articletypelists' => $articletypelists,
                'articles' => $articles,
                'tags' => $tags
            ]);
    }
}