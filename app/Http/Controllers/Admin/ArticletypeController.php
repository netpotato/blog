<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ArticletypeController extends Controller {

    // 文章类型列表页
    public function articletype_list() {
    	$articletypelists = DB::table('articletype')
                                ->orderByDesc("id")
                                ->paginate(10);
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

    // 修改文章类型页面
    public function articletype_update(Request $request) {
        $articletype_id = $request->post('id');

        $articletype_info = DB::table('articletype')->where('id', $articletype_id)->first();

        return view('admin.articletype.articletype_update', [
                'articletype_info' => $articletype_info
            ]);
    }

    // 修改文章类型
    public function update_articletype(Request $request) {
        $articletype_id = $request->post('articletype_id');
        $articletype_name = $request->post('articletype_name');

        $res = DB::table('articletype')->where('id', $articletype_id)->update([
            'type_name' => $articletype_name,
            'update_time' => Date("Y-m-d H:i:s", time())
        ]);

        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }
}