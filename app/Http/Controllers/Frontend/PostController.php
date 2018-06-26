<?php

namespace App\Http\Controllers\Frontend;


use App\Handlers\IpAddressHandler;
use App\Models\Comment;
use App\Models\Post;

class PostController extends BaseController
{

    /**
     * 获取博文详情
     * @param $alias
     * @return \Illuminate\Contracts\View\View
     */
    public function show($alias)
    {
        $post = Post::with(['comments'=>function($query){
			$query->where(['state'=>1])->withDepth();
		}])->where('alias', $alias)->firstOrFail();
        //上一篇
        $post['pre'] = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->first();
        //下一篇
        $post['next'] = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        //浏览记录自增
        $post->increment('views');
        return \View::make('post.detail', compact('post'));
    }

    public function list()
    {

    }

    public function message()
    {

    }
}
