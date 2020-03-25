<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

    public function index() {
    	$articletypelists = DB::table('articletype')->get();
    	$articles = DB::table('article')
    						->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
    						->leftjoin('image', function($join){ $join->on('article.image_id', '=', 'image.id'); })
    						->select('article.id', 'article.name', 'article.auth', 'article.title', 'article.image_id', 'article.insert_time', 'article.read_num', 'article.like_num', 'articletype.type_name', 'image.path')
    						->orderByDesc('article.id')
    						->get();
        return view('home.index', [
        		'articletypelists' => $articletypelists,
        		'articles' => $articles
        	]);
    }
}