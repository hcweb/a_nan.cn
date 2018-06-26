<?php

namespace App\Http\Controllers\Frontend;

use App\Handlers\IpAddressHandler;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class HomeController extends BaseController
{
    public function index()
    {
        $posts = $this->postRepository->scopeQuery(function ($query){
            return $query->where('is_show',1)->orderBy('created_at','desc');
        })->paginate(10);
        $postNum=$this->postRepository->findByField('is_show', '1')->count();
        $tagNum=count($this->tagRepository->all());
        return view('index', compact('posts','postNum','tagNum'));
    }

    public function show($id)
    {
       echo request()->input('alias');
    }
}
