<?php

/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-1-28
 * Time: 21:47
 */

namespace App\Repository;


use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    /**
     * @des 获取所有权限
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllPermission(){
        return Permission::all();
    }
}