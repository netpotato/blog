<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TagController extends Controller {

    // 标签列表页
    public function tag_list() {
    	$taglists = DB::table('tag')
                        ->orderByDesc("id")
                        ->paginate(10);
        return view('admin.tag.tag_list', [
	        	'taglists' => $taglists
        	]);
    }

    // 标签添加页
    public function tag_add() {
    	$taglists = DB::table('tag')->get();
        return view('admin.tag.tag_add', [
	        	'taglists' => $taglists
        	]);
    }

    // 添加标签
    public function add_tag(Request $request) {
    	$tag_name = $request->post('tag_name');

    	$res = DB::table('tag')->insert([
			'tag_name' => $tag_name,
			'insert_time' => Date("Y-m-d H:i:s", time())
		]);

		if ($res) {
			return 1;
		} else {
			return 0;
		}
    }

    // 删除标签
    public function delete_tag(Request $request) {
    	$tag_id = $request->post('tag_id');

    	$res = DB::table('tag')->where('id', $tag_id)->delete();

    	if ($res) {
			return 1;
		} else {
			return 0;
		}
    }

    // 修改标签页面
    public function tag_update(Request $request) {
        $tag_id = $request->post('id');

        $tag_info = DB::table('tag')->where('id', $tag_id)->first();

        return view('admin.tag.tag_update', [
                'tag_info' => $tag_info
            ]);
    }

    // 修改标签
    public function update_tag(Request $request) {
        $tag_id = $request->post('tag_id');
        $tag_name = $request->post('tag_name');

        $res = DB::table('tag')->where('id', $tag_id)->update([
            'tag_name' => $tag_name,
            'update_time' => Date("Y-m-d H:i:s", time())
        ]);

        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }
}