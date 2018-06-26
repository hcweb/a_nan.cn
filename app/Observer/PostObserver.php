<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/2/5
 * Time: 16:51
 */

namespace App\Observer;


use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        //dd($post);
    }

    public function deleting(Post $post)
    {
        $post->tags()->detach();
    }

    public function saving(Post $post)
    {
//        if (!is_null(request()->get('alias'))) {
//            request()->merge([
//                'alias' => kebab_case(studly_case(trim(request()->get('alias'))))
//            ]);
//        }
    }

    public function retrieved(Post $post)
    {
//        $result = array();
//        if (strlen($post->type) > 0) {
//            $post->type = explode(',', $post->type);
//            foreach ($post->type as $v) {
//                $result[$v] = $v;
//            }
//        }
//        $post->type = $result;
    }
}