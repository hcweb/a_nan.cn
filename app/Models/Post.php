<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{

    use Searchable;

    protected $table = 'posts';

    protected $fillable = ['title', 'alias', 'is_show', 'is_comment', 'is_top', 'is_hot', 'is_slide', 'is_tuijian', 'thumb', 'tags', 'order', 'views', 'push_time', 'url', 'source', 'author', 'summary', 'description', 'seo_title', 'seo_key', 'seo_content', 'category_id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_posts');
    }

    /**
     * 同步标签信息
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        Tag::addTags($tags);
        if (count($tags) > 0) {
            $this->tags()->sync(
                Tag::whereIn('name', $tags)->pluck('id')
            );
            return;
        }
        $this->tags()->detach();
    }

    public function searchableAs()
    {
        return 'post_index';
    }

    public function toSearchableArray()
    {
        return $this->toArray();
    }
}
