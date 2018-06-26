<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkItem extends Model
{
    //
    protected $table='link_items';

    protected $fillable=['link_id','title','url','logo','is_show','user_name','user_phone','user_email','order','description'];

    public function link(){
        return $this->belongsTo(Link::class);
    }
}
