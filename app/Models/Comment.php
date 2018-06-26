<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use NodeTrait;
    //
    protected $table = 'comments';

    protected $fillable = ['title', 'content', 'visitor', 'state', 'city', 'parent_id','_lft','_rgt', 'member_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
