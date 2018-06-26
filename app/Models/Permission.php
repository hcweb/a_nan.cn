<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public function menu()
    {
        return $this->hasOne(Menu::class);
    }
}
