<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/2/5
 * Time: 16:51
 */

namespace App\Observer;


use App\Models\Menu;

class MenuObserver
{
    /**
     * 监听数据即将删除的事件,删除子类及当前
     * @param Menu $menu
     */
    public function deleting(Menu $menu)
    {

    }


    /**
     * 监听数据删除后的事件
     * 删除当前菜单后如果还有子类则全部删除
     * @param Menu $menu
     */
    public function deleted(Menu $menu)
    {
        //获取子类
        if ($menu) {
            $child = getTree(Menu::all(), $menu->id);
            if (count($child) > 0) {
                foreach ($child as $v) {
                    Menu::destroy($v->id);
                }
            }
        }
    }
}