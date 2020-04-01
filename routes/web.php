<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'Home\IndexController@index');


//前台路由组
Route::namespace('Home')->group(function () {
	Route::get('/home', 'IndexController@index');
	Route::get('/home/index', 'IndexController@index');
	Route::get('/home/index/index', 'IndexController@index');

	Route::get('/home/article/detail', 'ArticleController@detail');
	Route::get('/home/articletype/article_list', 'ArticletypeController@info');
	Route::get('/home/tag/article_list', 'TagController@info');

	Route::post('/home/article/read_add', 'ArticleController@read_add');
	Route::post('/home/article/like_add', 'ArticleController@like_add');

});


//后台路由组
Route::namespace('Admin')->group(function () {
	Route::get('/admin/login/login', 'LoginController@login');
	Route::post('/admin/login/to_login', 'LoginController@to_login');
	Route::get('/admin/login/loging_out', 'LoginController@loging_out');
});

Route::group(['namespace'=>'Admin', 'middleware'=>'login'], function () {
	Route::get('/admin', 'IndexController@index');
	Route::get('/admin/index', 'IndexController@index');
	Route::get('/admin/index/index', 'IndexController@index');

	Route::get('/admin/article/list', 'ArticleController@article_list');
	Route::get('/admin/article/add', 'ArticleController@article_add');
	Route::get('/admin/article/update', 'ArticleController@article_update');
	Route::post('/admin/article/to_add', 'ArticleController@add_article');
	Route::post('/admin/article/to_delete', 'ArticleController@delete_article');
	Route::post('/admin/article/to_update', 'ArticleController@update_article');
	Route::post('/admin/article/upload_img', 'ArticleController@upload_img');
	Route::post('/admin/article/upload_edit_img', 'ArticleController@upload_edit_img');

	Route::get('/admin/articletype/list', 'ArticletypeController@articletype_list');
	Route::get('/admin/articletype/add', 'ArticletypeController@articletype_add');
	Route::get('/admin/articletype/update', 'ArticletypeController@articletype_update');
	Route::post('/admin/articletype/to_add', 'ArticletypeController@add_articletype');
	Route::post('/admin/articletype/to_delete', 'ArticletypeController@delete_articletype');
	Route::post('/admin/articletype/to_update', 'ArticletypeController@update_articletype');

	Route::get('/admin/tag/list', 'TagController@tag_list');
	Route::get('/admin/tag/add', 'TagController@tag_add');
	Route::get('/admin/tag/update', 'TagController@tag_update');
	Route::post('/admin/tag/to_add', 'TagController@add_tag');
	Route::post('/admin/tag/to_delete', 'TagController@delete_tag');
	Route::post('/admin/tag/to_update', 'TagController@update_tag');

});
