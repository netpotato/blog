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

});


//后台路由组
Route::namespace('Admin')->group(function () {
	Route::get('/admin', 'IndexController@index');
	Route::get('/admin/index', 'IndexController@index');
	Route::get('/admin/index/index', 'IndexController@index');

	Route::get('/admin/index/articletype_list', 'IndexController@articletype_list');
	Route::get('/admin/index/articletype_add', 'IndexController@articletype_add');
	Route::post('/admin/index/add_articletype', 'IndexController@add_articletype');
	Route::post('/admin/index/delete_articletype', 'IndexController@delete_articletype');

	Route::get('/admin/index/article_all_list', 'IndexController@article_all_list');
	Route::get('/admin/index/article_add', 'IndexController@article_add');
	Route::post('/admin/index/add_article', 'IndexController@add_article');
	Route::post('/admin/index/delete_article', 'IndexController@delete_article');
});