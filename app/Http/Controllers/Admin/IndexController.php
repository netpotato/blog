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
    	$articlelists = DB::table('article')
    						->leftjoin('articletype', function($join){ $join->on('article.articletype_id', '=', 'articletype.id'); })
    						->leftjoin('image', function($join){ $join->on('article.image_id', '=', 'image.id'); })
    						->select('article.id', 'article.name', 'article.title', 'article.image_id', 'article.insert_time', 'article.read_num', 'article.like_num', 'articletype.type_name', 'image.path')
    						->orderByDesc('article.id')
    						->get();
        return view('admin.article.article_all_list', [
	        	'articlelists' => $articlelists
        	]);
    }

    // 文章添加页
    public function article_add() {
    	$articletypelists = DB::table('articletype')->get();
        return view('admin.article.article_add', [
	        	'articletypelists' => $articletypelists
        	]);
    }

    // 图片上传
    public function upload_img(Request $request) {
    	$file = $request->file('file');
        if($file == null){
            exit(json_encode(array('code'=>1, 'msg'=>'没有上传任何图片文件')));
        }
        //图片存储根目录
        $path = "./uploads/show-images";
        //获取文件后缀
        $ext = $file->getClientOriginalExtension();
         //获取文件创建当前日期
        $date = date('Ymd');
        //新创建文件名及其后缀
        $newFile = md5(time().rand(1111, 9999)) . '.' . $ext;
        //构造目录
        $tree = $path . '/' . $date;
        if (file_exists($date)) {
            mkdir($tree, 0777);
        }
        //将新文件移动至对应文件夹下
        $file->move($tree, $newFile);
        // $imgPath = $tree . '/' . $newFile;
        // ./uploads 前端将无法展示
        $imgPath = "/uploads/show-images" . '/' . $date . '/' . $newFile;

        $image_id = DB::table('image')->insertGetId([
			'path' => $imgPath,
			'url' => $imgPath,
			'insert_time' => Date("Y-m-d H:i:s", time())
		]);

        if ($imgPath!=null && $image_id) {
            exit(json_encode(array('code'=>1, 'image_id'=>$image_id, 'msg'=>$imgPath)));
        } else {
            exit(json_encode(array('code'=>0, 'msg'=>'上传失败')));
        }
    }

    // 文章内容图片
    public function upload_edit_img(Request $request) {
    	$file = $request->file('file');
        if($file == null){
            exit(json_encode(array('code'=>1, 'msg'=>'没有上传任何图片文件')));
        }
        //图片存储根目录
        $path = "./uploads/edit-images";
        //获取文件后缀
        $ext = $file->getClientOriginalExtension();
         //获取文件创建当前日期
        $date = date('Ymd');
        //新创建文件名及其后缀
        $newFile = md5(time().rand(1111, 9999)) . '.' . $ext;
        //构造目录
        $tree = $path . '/' . $date;
        if (file_exists($date)) {
            mkdir($tree, 0777);
        }
        //将新文件移动至对应文件夹下
        $file->move($tree, $newFile);
        // $imgPath = $tree . '/' . $newFile;
		// ./uploads 前端将无法展示
        $imgPath = "/uploads/edit-images" . '/' . $date . '/' . $newFile;
        
        $image_id = DB::table('editimage')->insertGetId([
			'path' => $imgPath,
			'url' => $imgPath,
			'insert_time' => Date("Y-m-d H:i:s", time())
		]);

        if ($imgPath!=null) {
            exit(json_encode(array('code'=>1, 'msg'=>$imgPath, 'data'=>array('src'=>$imgPath, 'title'=>'img'))));
        } else {
            exit(json_encode(array('code'=>0, 'msg'=>'上传失败')));
        }
    }

    // 添加文章
    public function add_article(Request $request) {
    	$articletype_id = $request->post('articletype_id');
    	$name = $request->post('name');
    	$auth = $request->post('auth');
    	$title = $request->post('title');
    	$image_id = $request->post('image_id');
    	$content = $request->post('content');

    	$res = DB::table('article')->insert([
			'articletype_id' => $articletype_id,
			'name' => $name,
			'auth' => $auth,
			'title' => $title,
			'image_id' => $image_id,
			'content' => $content,
			'insert_time' => Date("Y-m-d H:i:s", time()),
			'read_num' => 0,
			'like_num' => 0
		]);

		if ($res) {
			return 1;
		} else {
			return 0;
		}
    }

    // 删除文章
    public function delete_article(Request $request) {
    	$article_id = $request->post('article_id');

    	$res = DB::table('article')->where('id', $article_id)->delete();

    	if ($res) {
			return 1;
		} else {
			return 0;
		}
    }
}