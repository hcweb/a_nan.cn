<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Menu;
use App\Repository\PermissionRepository;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends CommonController
{
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @des 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $permissions = \DB::table('permissions')
            ->join('menus', 'permissions.menu_id', '=', 'menus.id')
            ->select('permissions.*', 'menus.title', 'menus.route')
            ->paginate(10);
        return view('backend.permission.index', compact('permissions'));
    }

    /**
     * 创建权限
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $menus = $this->getSelectData();
        return view('backend.permission.create', compact('menus'));
    }


    /**
     * 保存权限
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        if (Permission::create($request->all())) {
            alert()->success('权限创建成功!');
            return redirect()->route('permission.index');
        } else {
            alert()->error('权限创建失败!');
            return redirect()->back();
        }
    }

    /**
     * @des 编辑查询数据
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Permission $permission)
    {
        $menus = $this->getSelectData();
        $permission = Permission::findOrFail($permission->id);
        return view('backend.permission.edit', compact('menus', 'permission'));
    }

    /**
     * @des 更新保存信息
     * @param PermissionRequest $request
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $per = Permission::findOrFail($permission->id);
        if ($per->update($request->except('permission_id'))) {
            alert()->success('权限更新成功!');
            return redirect()->route('permission.index');
        } else {
            alert()->error('权限更新失败!');
            return redirect()->back();
        }
    }

    /**
     * @des 删除权限
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Permission::destroy($id);
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

        }
        return response()->json($data);
    }

    /**
     * @des 搜索权限
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $menus = $this->getSelectData();
        $permissions = Permission::where('alias', 'like', '%' . trim($request->input('keywords')) . '%')
            ->paginate(10);
        return view('backend.permission.index', compact('permissions', 'menus'));
    }

    /**
     * @des 获取缓存数据
     * @return \Illuminate\Cache\CacheManager|mixed
     */
    private function getSelectData()
    {
        $menu = Menu::where('is_show', '1')->orderBy('order', 'desc')->get();
        $result = getSelectData(getTree($menu));
        return array_except($result, 0);
    }
}
