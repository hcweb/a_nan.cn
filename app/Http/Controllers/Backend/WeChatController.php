<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeChatController extends CommonController
{
    protected $app;

    public function __construct()
    {
        parent::__construct();
        $this->app=app('wechat.official_account');
    }

    //
    public function serve(){
        \Log::info('wecha请求信息');
        $this->app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });
        return  $this->app->server->serve();
    }

    public function getArticles(){
        $list=$this->app->material->list('news',0,10);
        return $list;
    }
}
