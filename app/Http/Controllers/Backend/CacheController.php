<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CacheController extends Controller
{
    //清除配置文件缓存
    public function clearConfigCache()
    {
        $reslut = \Artisan::call('config:cache');
        return redirect()->route('home');
    }

    //清除路由文件缓存
    public function clearRouteCache()
    {
        $reslut = \Artisan::call('config:cache');
        return redirect()->route('home');
    }

}
