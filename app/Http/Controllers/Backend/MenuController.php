<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Menu;
use App\Repository\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuController extends CommonController
{
    protected $menuRepository;

    function __construct(MenuRepository $menuRepository)
    {
        parent::__construct();
        $this->menuRepository = $menuRepository;

    }

    /**
     * 菜单首页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Menu::orderBy('order', 'asc')->get();
        $menus = $this->menuRepository->getMenuTree($data);
        return view('backend.menu.index', compact('menus'));
    }


    /**
     * 菜单创建页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $treeMenu = $this->getSelectDataTree();
        return view('backend.menu.create', compact('treeMenu'));
    }


    /**
     * 保存菜单
     * @param MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuRequest $request)
    {
        return $this->menuRepository->createMenu($request->all());
    }

    /**
     * 显示菜单
     * @param  \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * 编辑界面
     * @param  \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $treeMenu = $this->getSelectDataTree();
        return view('backend.menu.edit', compact('menu', 'treeMenu'));
    }


    /**
     * 更新菜单
     * @param MenuRequest $request
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        return $this->menuRepository->updateMenu($request->all(), $menu);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->menuRepository->destroyMenu($id);
    }

    /**
     * 获取菜单下拉数据
     * @return array
     */
    private function getSelectDataTree()
    {
        $menus = Menu::where('is_show', 1)->orderBy('order', 'asc')->get();
        return getSelectData($this->menuRepository->getMenuTree($menus));
    }

    /**
     * ajax更新菜单排序
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function menuOrder(Request $request)
    {
        $menu = $this->menuRepository->updateOrderMenuById(trim($request->id), trim($request->order));
        if ($menu) {
            $data = [
                'msg' => '菜单更新成功!',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '菜单更新失败!',
                'success' => false
            ];
        }
        return response()->json($data);
    }

    /**
     * 搜索
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $menus = Menu::where('title', 'like', '%' . trim($request->input('keywords')) . '%')
            ->orderBy('order', 'desc')
            ->get();
        return view('backend.menu.index', compact('menus'));
    }
}
