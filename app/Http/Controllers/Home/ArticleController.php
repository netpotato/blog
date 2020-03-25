<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller {

    public function detail(Request $request) {
        $article_id = $request->get('article_id');
    	$articleinfo = DB::table('article')->where('id', '=', $article_id)->get();
        return view('home.article.detail', [
        		'articleinfo' => $articleinfo
        	]);
    }
}