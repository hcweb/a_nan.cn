<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SystemRequest;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SystemController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $systems = System::orderBy('order','ASC')->get();
        return view('backend.system.index', compact('systems'));
    }

    /**
     * 创建配置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.system.create');
    }

    /**
     * 保存配置信息
     * @param SystemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SystemRequest $request)
    {
        switch ($request->get('type')) {
            case 'radio':
                $request->merge(['content' => $request->get('value')]);
                break;
        }
        if (System::create($request->all())) {
            $this->putSystemConfig();
            alert()->success('配置添加成功!');
            return redirect()->route('system.index');
        } else {
            alert()->error('配置添加失败!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System $system
     * @return \Illuminate\Http\Response
     */
    public function show(System $system)
    {
        //
    }

    /**
     * 编辑配置
     * @param  \App\Models\System $system
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        $system = System::findOrFail($system->id);
        return view('backend.system.edit', compact('system'));
    }

    /**
     * 更新配置
     * @param  SystemRequest $request
     * @param  \App\Models\System $system
     * @return \Illuminate\Http\Response
     */
    public function update(SystemRequest $request, System $system)
    {
        switch ($request->get('type')) {
            case 'radio':
                $request->merge(['content' => $request->get('value')]);
                break;
        }
        $system = System::findOrFail($system->id);
        if ($system->update($request->all())) {
            $this->putSystemConfig();
            alert()->success('配置更新成功!');
            return redirect()->route('system.index');
        } else {
            alert()->error('配置更新失败!');
            return redirect()->back();
        }
    }

    /**
     * @des 删除配置
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = System::destroy($id);
            if ($result) {
                $this->putSystemConfig();
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
     * @des 搜索配置
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $systems = Permission::where('title', 'like', '%' . trim($request->input('keywords')) . '%')
            ->paginate(10);
        return view('backend.system.index', compact('systems'));
    }

    /**
     * 生成配置文件
     */
    private function putSystemConfig()
    {
        $systems = System::pluck('content', 'name')->all();
        $path = config_path() . '\web-config.php';
        $content = '<?php return ' . var_export($systems, true) . ';';
        file_put_contents($path, $content);
    }

    /**
     * ajax更新数据
     * @param Request $request
     */
    public function updateContentById(Request $request)
    {
        $system = System::findOrFail($request->get('id'));

        if ($system->type == 'radio') {
            $system->value = (int)$request->get('content');
        }
        $system->content = $request->get('content');

        if ($system->save()) {
            $this->putSystemConfig();
        }
    }

    /**
     * ajax更新菜单排序
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function systemOrder(Request $request)
    {
        $system = System::findOrFail($request->get('id'));
        if ($system->update($request->all())) {
            $data = [
                'msg' => '排序更新成功!',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '排序更新失败!',
                'success' => false
            ];
        }
        return response()->json($data);
    }
}
