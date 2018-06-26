<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-4-11
 * Time: 22:18
 */

namespace App\Api\Transformers;


use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        return [
            'title' => $post->title,
            'author' => $post->author
        ];
    }
}