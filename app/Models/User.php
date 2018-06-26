<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'tel', 'is_enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    protected static function boot()
//    {
//        parent::boot();
//        self::creating(function ($user) {
//            $user->password = bcrypt($user->password);
//        });
//    }

    /**
     * 根据角色名称获取角色别名
     * @param $roleName
     * @return mixed
     */
    public function getAliasByRoleName($roleName)
    {
        $alias = $this->roles()->where('name',$roleName)->value('alias');
        return $alias;
    }
}
