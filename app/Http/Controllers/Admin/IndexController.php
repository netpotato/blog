<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

	// 主页
    public function index() {
        return view('admin.index');
    }

    // 文章类型列表页
    public function articletype_list() {
    	$articletypelists = DB::table('articletype')->orderByDesc("id")->get();
        return view('admin.articletype.articletype_list', [
	        	'articletypelists' => $articletypelists
        	]);
    }

    // 文章类型添加页
    public function articletype_add() {
    	$articletypelists = DB::table('articletype')->get();
        return view('admin.articletype.articletype_add', [
	        	'articletypelists' => $articletypelists
        	]);
    }

    // 添加文章类型
    public function add_articletype(Request $request) {
    	$articletype_name = $request->post('articletype_name');

    	$res = DB::table('articletype')->insert([
			'type_name' => $articletype_name,
			'insert_time' => Date("Y-m-d H:i:s", time())
		]);

		if ($res) {
			return 1;
		} else {
			return 0;
		}
    }

    // 删除文章类型
    public function delete_articletype(Request $request) {
    	$articletype_id = $request->post('articletype_id');

    	$res = DB::table('articletype')->where('id', $articletype_id)->delete();

    	if ($res) {
			return 1;
		} else {
			return 0;
		}
    }

    // 文章列表页
    public function article_all_list() {
    	$articlelists = DB::table('article')->orderByDesc("id")->get();
        return view('admin.article.article_all_list', [
	        	'articlelists' => $articlelists
        	]);
    }

    // 文章添加页
    public function article_add() {
    	$articlelists = DB::table('article')->get();
        return view('admin.article.article_add', [
	        	'articlelists' => $articlelists
        	]);
    }
}