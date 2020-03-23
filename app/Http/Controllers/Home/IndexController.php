<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

    public function index() {
    	$articletypelists = DB::table('articletype')->get();
    	$articles = DB::table('article')->get();
        return view('home.index', [
        		'articletypelists' => $articletypelists,
        		'articles' => $articles
        	]);
    }
}