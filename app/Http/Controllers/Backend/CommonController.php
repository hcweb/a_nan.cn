<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class CommonController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        \View::share('adminMenu',make_tree_menu(collect($this->getMenus())->toArray()));
    }

    public function getMenus()
    {
        $menu = Menu::where('is_show', '1')->orderBy('order', 'desc')->get();
        return $menu;
    }

    /**
     * 从redis中获取数据
     * @return bool|string
     */
    private function getAllMenuFromCache()
    {
        $menu = Menu::where('is_show', '1')->orderBy('order', 'desc')->get();
        //把所有后台菜单存入缓存中
        if (!Cache::has('admin.menu')) {
            $result = collect($menu);
            Cache::forever('admin.menu', make_tree_menu($result->toArray()));
        }
        //把select数据存入缓存中
        if (!Cache::has('admin.select.menu')){
            Cache::forever('admin.select.menu',getSelectData(getTree($menu)));
        }

        //把权限存入缓存中
        if (!Cache::has('admin.permission')){
            Cache::forever('admin.permission',Permission::all());
        }
    }
}
