<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $table = 'categorys';

    protected $fillable=['title','route','target','icon_class','color','height_url','parent_id','order','is_show','alias','seo_title','seo_key','seo_content','url','thumb','description','_lft','_rgt'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
