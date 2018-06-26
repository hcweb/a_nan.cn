<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends CommonController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $roles = Role::all();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * @des 创建角色
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $allPermissions=$this->getAllPermissions();
        return view('backend.role.create',compact('allPermissions'));
    }


    /**
     * 保存角色
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        try {
            //开启数据库事务
            \DB::transaction(function () use ($request) {
                //保存角色信息
                $role = Role::create($request->except(['permissions', '_token']));
                //保存权限
                $role->givePermissionTo($request->input('permissions'));

                alert()->success('角色添加成功！', '2131');
            });
        } catch (QueryException $exception) {
            alert()->error('角色添加失败！', '123123');
        }
        return redirect()->route('role.index');
    }

    /**
     * 角色详情页面
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findById($id);
        return view('backend.role.show', compact('role'));
    }

    /**
     * 编辑角色
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        $allPermissions=$this->getAllPermissions();
        $permissions = array();
        if (count($role->permissions) > 0) {
            foreach ($role->permissions as $v) {
                array_push($permissions, $v->name);
            }
        }
        return view('backend.role.edit', compact('role', 'permissions','allPermissions'));
    }

    /**
     * 更新角色.
     * @param  RoleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findById($id);
        try {
            //开启数据库事务
            \DB::transaction(function () use ($request, $role) {
                //保存角色信息
                $role->update($request->except(['role_id', 'permissions']));
                //先删除权限
                foreach ($role->permissions as $v) {
                    $role->revokePermissionTo($v);
                }
                $role->syncPermissions($request->input('permissions'));

                alert()->success('角色更新成功！', '');
            });
        } catch (QueryException $exception) {
            alert()->error('角色更新失败！', '');
        }
        return redirect()->route('role.index');
    }

    /**
     * 删除权限
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Role::destroy($id);
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

    /**
     * 搜索
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $roles = Role::where('alias', 'like', '%' . trim($request->input('keywords')) . '%')
            ->get();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * 获取所有权限
     */
    private function getAllPermissions(){
        return Permission::all();
    }
}
