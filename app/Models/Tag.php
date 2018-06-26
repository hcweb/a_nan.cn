<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tag_posts');
    }

    /**
     * 添加标签
     * @param array $tags
     */
    public static function addTags(array $tags)
    {
        if (count($tags) === 0) {
            return;
        }
        $allTags = static::whereIn('name', $tags)->pluck('name')->toArray();

        //把不同的保存起来
        foreach (array_diff($tags, $allTags) as $tag) {
            static::create([
                'name' => $tag
            ]);
        }
    }
}
