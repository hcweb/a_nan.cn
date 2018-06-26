<?php

namespace App\Http\Controllers\Frontend;

use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BaseController
{
    //更具栏目别名获取文章列表
    public function lists($alias=null)
    {
        $posts=null;
        if ($alias){
            $category = $this->categoryRepository
                ->with('ancestors')
                ->findByField('alias', $alias)
                ->first();
            $posts=$category->posts()->paginate(2);
        }else{
            $posts=$this->postRepository->paginate(3);
        }
        return \View::make('post.list', compact('category','posts'));
    }
}
