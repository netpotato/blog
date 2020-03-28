<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller {

	// 登录页面
    public function login() {
        return view('admin.login.login');
    }

    // 登录
    public function to_login(Request $request) {
    	$username = $request->post('username');
    	$password = $request->post('password');
    	
    	$res = DB::table('user')
    				->where('username', '=', $username)
    				->where('password', '=', md5($password))
    				->first();
    	if ($res) {
            Session::put('userid', $res->id);
    		Session::put('username', $res->username);
    		return 1;
    	} else {
    		return 0;
    	}
    }

    // 登出
    public function loging_out() {
    	Session::forget('userid');
    	return view('admin.login.login');
    }
}