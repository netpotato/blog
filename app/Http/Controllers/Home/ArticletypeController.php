<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticletypeController extends Controller {

    // 类型文章列表页面
    public function info(Request $request) {
        $articletype_id = $request->get('articletype_id');
        $articletypelists = DB::table('article')
                                ->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
                                ->select(DB::raw('articletype_id, count(*) as type_have_count, type_name'))
                                ->groupBy('article.articletype_id')
                                ->get();
    	$articles = DB::table('article')
                        ->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
                        ->leftjoin('image', function($join){ $join->on('article.image_id', '=', 'image.id'); })
                        ->select('article.id', 'article.name', 'article.auth', 'article.title', 'article.image_id', 'article.insert_time', 'article.pv', 'article.read_num', 'article.like_num', 'articletype.type_name', 'image.path')
                        ->where('article.articletype_id', '=', $articletype_id)
                        ->orderByDesc('article.id')
                        ->paginate(5);
        $tags = DB::table('tag')
                        ->select('id', 'tag_name')
                        ->get();
        return view('home.articletype.article_list', [
                'articletype_id' => $articletype_id,
                'articletypelists' => $articletypelists,
                'articles' => $articles,
                'tags' => $tags
        	]);
    }
}