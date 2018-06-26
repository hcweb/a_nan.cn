<?php

/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-1-28
 * Time: 21:47
 */

namespace App\Repository;

use App\Models\Menu;

class MenuRepository
{
    /**
     * @des 创建分类
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createMenu($data)
    {
        if ($data) {
            $result = Menu::create($data);
            if ($result) {
                alert()->success('', "分类创建成功！O(∩_∩)O");
                return redirect()->route('menu.index');
            } else {
                alert()->error('', "分类创建失败！(T_T)");
                return back();
            }
        } else {
            alert()->error('', "数据不能为空！");
        }
    }

    /**
     * 获取分类树菜单
     * @return array
     */
    public function getMenuTree($menus)
    {
        return getTree($menus);
    }

    /**
     * 更新菜单
     * @param $data
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMenu($data, Menu $menu)
    {
        if ($menu->update($data)) {
            alert()->success('', "菜单更新成功！O(∩_∩)O");
            return redirect()->route('menu.index');
        } else {
            alert()->error('', "菜单更新失败！(T_T)");
            return back();
        }
    }

    /**
     * 查询单个菜单
     * @param $id
     * @return mixed
     */
    public function findMenuById($id)
    {
        $menu = Menu::findOrFail($id);
        return $menu;
    }


    /**
     *更新菜单排序
     * @param $id
     * @param $order
     * @return mixed
     */
    public function updateOrderMenuById($id, $order)
    {
        return Menu::where('id', $id)->update(
            ['order' => $order]
        );
    }


    /**
     * 删除菜单
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyMenu($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Menu::destroy($id);
            if ($result) {
                $data = [
                    'msg' => '删除成功!',
                    'success' => true
                ];
            } else {
                $data = [
                    'msg' => '删除失败!',
                    'success' => false
                ];
            }
            return response()->json($data);
        } else {
            abort('404');
        }
    }
}