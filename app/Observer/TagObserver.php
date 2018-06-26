<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/2/5
 * Time: 16:51
 */

namespace App\Observer;


use App\Models\Tag;

class TagObserver
{

    public function deleting(Tag $tag)
    {
        $tag->posts()->detach();
    }
}