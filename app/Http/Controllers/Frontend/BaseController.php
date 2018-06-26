<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;

class BaseController extends Controller
{


    protected $categoryRepository;
    protected $tagRepository;
    protected $postRepository;

    function __construct(CategoryRepository $categoryRepository,TagRepository $tagRepository,PostRepository $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->postRepository=$postRepository;

        if (!empty(config('web-theme.theme'))) {
            $this->middleware('setTheme:' . config('web-theme.theme'));
        } else {
            abort(404);
        }
		
        \View::share('tags', $this->getAllTags());
        \View::share('categorys', $this->getCategorys()->toTree());
        \View::share('hotPosts', $this->getHotPosts());
    }

    /**
     * 获取所有标签
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getAllTags()
    {
        return Tag::all();
    }

    /**
     * 获取所有分类
     * @return mixed
     */
    private function getCategorys()
    {
        return $this->categoryRepository->scopeQuery(function ($query) {
            return $query->where(['is_show' => '1'])->orderBy('order', 'DESC');
        })->all();
    }

    /**
     * 获取热门文章
     * @return mixed
     */
    private function getHotPosts()
    {
        return Post::where(['is_show' => '1', 'is_hot' => '1'])->orderBy('created_at', 'DESC')->get();
    }
}
