<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['name'];

    public function linkItems()
    {
        return $this->hasMany(LinkItem::class);
    }
}
