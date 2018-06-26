<?php

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

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@index')->name('frontend');
    Route::get('post/{alias}', 'PostController@show')->name('front.post.detail');
    Route::get('category/{alias?}', 'CategoryController@lists')->name('category.list');
    Route::get('tag/{alias}', 'TagController@getPostByTag')->name('tag.list');
    Route::get('message', 'PostController@message')->name('front.message');
    Route::post('saveComment/', 'CommentController@store')->name('front.comment.save');
    Route::get('/oauth/github', 'UserController@redirectToGithubProvider');
    Route::get('/oauth/github/callback', 'UserController@handleGithubProviderCallback');
    Route::get('/oauth/qq', 'UserController@redirectToQqbProvider');
    Route::get('/oauth/qq/callback', 'UserController@handleQqProviderCallback');
	Route::get('/layout', 'UserController@layout');
	Route::get('/search',function (){
	    dd(\App\Models\Post::search('baidu-news-the-worlds-largest-chinese-news-platform')->get()->toArray());
    });
});


Route::group(['namespace' => 'Backend', 'prefix' => 'backend'], function () {
    //用户登录相关路由
    Route::post('/loginForm', 'UserController@loginForm')->name('loginForm');
    Route::get('/login', 'UserController@login')->name('login');
    Route::get('/layout', 'UserController@layout')->name('layout');


    Route::middleware(['auth'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/clear', 'HomeController@clearCache')->name('clear');

        Route::middleware(['authentication'])->group(function () {
            //清除缓存信息
            Route::get('/clearConfigCache', 'CacheController@clearConfigCache')->name('clear.config.cache');
            Route::get('/clearRouteCache', 'CacheController@clearRouteCache')->name('clear.route.cache');

            Route::get('/home', 'HomeController@index')->name('home');
            Route::resource('/user', 'UserController');
            Route::post('user/avatar', 'UserController@avatar')->name('user.avatar');
            Route::post('user/avatar/crop', 'UserController@cropAvatar')->name('user.avatar.crop');
            Route::post('user/search', 'UserController@search')->name('user.search');

            //菜单相关
            Route::resource('menu', 'MenuController');
            Route::post('menu/search', 'MenuController@search')->name('menu.search');
            Route::post('menu/updateOrder', 'MenuController@menuOrder')->name('menu.update.order');

            //角色相关
            Route::resource('role', 'RoleController');
            Route::post('role/search', 'RoleController@search')->name('role.search');

            //权限相关
            Route::resource('permission', 'PermissionController');
            Route::post('permission/search', 'PermissionController@search')->name('permission.search');

            //系统配置
            Route::resource('system', 'SystemController');
            Route::post('system/updateContent', 'SystemController@updateContentById')->name('system.updateContent');
            Route::post('system/updateOrder', 'SystemController@systemOrder')->name('system.update.order');

            //会员管理
            Route::resource('member', 'MemberController');

            //标签管理
            Route::resource('block', 'BlockController');
            Route::post('block/updateBody', 'BlockController@updateBodyById')->name('block.updateBody');

            //文章管理
            Route::resource('post', 'PostController');
            Route::post('post/updateOrder', 'PostController@postUpdateOrder')->name('post.update.order');
            Route::post('post/updateType', 'PostController@postUpdateTuiJianType')->name('post.type.order');
            Route::post('post/search', 'PostController@search')->name('post.search');


            //留言管理
            Route::resource('message', 'MessageController');

            //评论管理
            Route::resource('comment', 'CommentController');

            //前台菜单
            Route::resource('category', 'CategoryController');
            Route::post('category/search', 'CategoryController@search')->name('category.search');
            Route::post('category/updateOrder', 'CategoryController@categoryOrder')->name('category.update.order');

            //友情链接
            Route::resource('link', 'LinkController');
            Route::post('link/create/linkCategory', 'LinkController@createLinkCategory')->name('create.linkCategory');
            Route::delete('link/destroy/{id}', 'LinkController@destroyLinkCategory')->name('destroy.linkCategory');

            Route::post('link/search', 'LinkController@search')->name('link.search');
            Route::post('link/updateOrder', 'LinkController@linkUpdateOrder')->name('link.update.order');

            //模板管理
            Route::resource('theme', 'ThemeController');
            Route::post('theme/updateTheme', 'ThemeController@updateTheme')->name('theme.update');

            //标签管理
            Route::resource('tag', 'TagController')->only('index', 'destroy');
            Route::post('tag/createAndUpdate', 'TagController@createAndUpdateTag')->name('tag.create.and.update');

            //数据库备份与还原
            Route::get('database/{type?}','DatabaseController@index')->name('database');
            Route::any('/database_export','DatabaseController@export');
            Route::any('/database_import','DatabaseController@import');
            Route::get('/database_del_file/{time}','DatabaseController@delFile');
        });
    });

});


Route::group(['prefix' => 'file'], function () {
    Route::post('upload', 'Common\UploadController@upload')->name('file.upload');
    Route::post('remove', 'Common\UploadController@remove')->name('file.remove');
});


Route::get('translate/{title}', 'Common\TranslateController@translate')->name('translate');


Route::any('/wechat','Backend\WeChatController@serve');
Route::get('/wechat/article','Backend\WeChatController@getArticles');
