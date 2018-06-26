<?php

namespace App\Http\Controllers\Frontend;

use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends BaseController
{
    public function getPostByTag($tagName)
    {
        $tag=$this->tagRepository->findByField('name',$tagName)->first();
        $posts=$tag->posts()
            ->where('is_show',1)
            ->paginate(15);
        return \View::make('post.list',compact('posts','tag'));
    }
}
