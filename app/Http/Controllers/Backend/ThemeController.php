<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ThemeRequest;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends CommonController
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $themes = Theme::all();
        $states = collect($themes)->pluck('is_enabled')->all();
        return view('backend.theme.index', compact('themes', 'states'));
    }


    /**
     * 创建主题
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $folders = $this->getThemePath();
        if (!is_null($folders)) {
            return view('backend.theme.create', compact('folders'));
        } else {
            alert()->error('没有获取到主题模板,请先创建主题！');
            return redirect()->back();
        }
    }


    /**
     * 保存主题信息
     * @param ThemeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ThemeRequest $request)
    {
        if (Theme::create($request->all())) {
            alert()->success('主题创建成功！');
            return redirect()->route('theme.index');
        } else {
            alert()->error('主题创建失败！');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }


    /**
     * 修改主题
     * @param Theme $theme
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Theme $theme)
    {
        $folders = $this->getThemePath();
        if (!is_null($folders)) {
            $theme = Theme::findOrFail($theme->id);
            return view('backend.theme.edit', compact('theme', 'folders'));
        } else {
            alert()->error('没有获取到主题模板,请先创建主题！');
            return redirect()->back();
        }

    }

    /**
     * 保存更新信息
     * @param ThemeRequest $request
     * @param Theme $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ThemeRequest $request, Theme $theme)
    {
        $theme = Theme::findOrFail($theme->id);
        if ($theme->update($request->all())) {
            alert()->success('主题修改成功！');
            return redirect()->route('theme.index');
        } else {
            alert()->error('主题修改失败！');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Theme::destroy($id);
            if ($result) {
                $themes = Theme::all();
                if (count($themes) > 0) {
                    foreach ($themes as $v) {
                        if ($v->is_enabled == 1) {
                            $this->putThemeConfig([
                                'theme' => $v->theme
                            ]);
                        } else {
                            $this->putThemeConfig([
                                'theme' => ''
                            ]);
                        }
                    }
                } else {
                    $this->putThemeConfig([
                        'theme' => ''
                    ]);
                }

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
     * ajax设置推荐类型
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTheme(Request $request)
    {
        $theme = Theme::findOrFail($request->get('id'));
        $theme->is_enabled = $request->get('is_enabled');
        if ($result = $theme->save()) {
            $this->putThemeConfig([
                'theme' => $theme->is_enabled == 1 ? $theme->theme : ''
            ]);
            $data = [
                'msg' => '',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '',
                'success' => false
            ];
        }
        return response()->json($data);
    }

    /**
     * 生成配置文件
     */
    private function putThemeConfig($theme = array())
    {
        $path = config_path() . '\web-theme.php';
        $content = '<?php return ' . var_export($theme, true) . ';';
        file_put_contents($path, $content);
    }

    /**
     * 获取主题文件夹路径
     * @return array|null
     */
    private function getThemePath()
    {
        $path = resource_path() . '/views/themes';
        if (is_dir($path)) {
            $folders = array_diff(scandir($path), array('.', '..'));
            if (count($folders) > 0) {
                $result = [];
                foreach ($folders as $v) {
                    $result[$v] = $v;
                }
                return array_reverse(array_set($result, 'chosePath', '请选择模板'));
            } else {
                return null;
            }

        } else {
            return null;
        }
    }
}
