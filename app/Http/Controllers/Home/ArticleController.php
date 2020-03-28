<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller {

    // 文章详情页面
    public function detail(Request $request) {
        $article_id = $request->get('article_id');
        $articletypelists = DB::table('article')
                                ->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
                                ->select(DB::raw('articletype_id, count(*) as type_have_count, type_name'))
                                ->groupBy('article.articletype_id')
                                ->get();
    	$articleinfo = DB::table('article')
                            ->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
                            ->select('article.id', 'article.name', 'article.auth', 'article.title', 'article.tag', 'article.content', 'article.image_id', 'article.insert_time', 'article.pv', 'article.read_num', 'article.like_num', 'articletype.type_name')
                            ->where('article.id', '=', $article_id)->first();
        return view('home.article.detail', [
                'articletypelists' => $articletypelists,
                'articleinfo' => $articleinfo
        	]);
    }

    public function read_add(Request $request) {
        $article_id = $request->get('article_id');
        $ip = $request->get('ip');
        $address = $request->get('address');

        DB::table('article')->where('id', '=', $article_id)->increment('pv');

        $res = DB::table('read')
                ->where('article_id', '=', $article_id)
                ->where('ip', '=', $ip)
                ->count();

        if (0 == $res) {
            DB::table('read')->insert([
                'article_id' => $article_id,
                'ip' => $ip,
                'address' => $address,
                'insert_time' => Date("Y-m-d H:i:s")
            ]);
            $res = DB::table('article')->where('id', '=', $article_id)->increment('read_num');
            if ($res) { return 1; }
        }        
    }

    public function like_add(Request $request) {
        $article_id = $request->get('article_id');
        $ip = $request->get('ip');
        $address = $request->get('address');

        $res = DB::table('like')
                ->where('article_id', '=', $article_id)
                ->where('ip', '=', $ip)
                ->count();

        if (0 == $res) {
            DB::table('like')->insert([
                'article_id' => $article_id,
                'ip' => $ip,
                'address' => $address,
                'insert_time' => Date("Y-m-d H:i:s")
            ]);
            $res = DB::table('article')->where('id', '=', $article_id)->increment('like_num');
            if ($res) { return 1; }
        }        
    }
}