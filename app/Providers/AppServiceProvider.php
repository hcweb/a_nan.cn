<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Post;
use App\Models\Tag;
use App\Observer\MenuObserver;
use App\Observer\PostObserver;
use App\Observer\TagObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 增加内存防止中文分词报错
         */
        ini_set('memory_limit', "1024M");
        //
        Carbon::setLocale('zh');
        \Schema::defaultStringLength(191);
        Menu::observe(MenuObserver::class);
        Post::observe(PostObserver::class);
        Tag::observe(TagObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
