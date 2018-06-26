<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = ['title', 'route', 'target', 'icon_class', 'color', 'height_url', 'parent_id', 'order', 'is_show'];


    //获取所有子类
    public function childrenMneus()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    //获取父类
    public function parentMenu()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
