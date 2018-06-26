<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends CommonController
{
    protected $categoryRepository;

    function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 分类首页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->categoryRepository->scopeQuery(function ($query) {
            return $query->orderBy('order', 'asc')->withDepth();
        })->get();
        $categorys = $data->toFlatTree();
        return view('backend.category.index', compact('categorys'));
    }


    /**
     * 菜单创建页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $treeMenu = $this->getSelectDataTree();
        return view('backend.category.create', compact('treeMenu'));
    }


    /**
     * 保存菜单
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        if ($this->categoryRepository->create($request->all())) {
            alert()->success(config('json-tip.category.create_success'));
            return redirect()->route('category.index');
        }
        alert()->error(config('json-tip.category.create_error'));
        return redirect()->back();
    }

    /**
     * 显示菜单
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * 编辑界面
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $treeMenu = $this->getSelectDataTree();
        return view('backend.category.edit', compact('category', 'treeMenu'));
    }


    /**
     * 更新菜单
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //$request->merge(['alias'=>kebab_case(studly_case(trim($request->get('alias'))))]);
        if ($category->update($request->all())) {
            alert()->success(config('json-tip.category.update_success'));
            return redirect()->route('category.index');
        }
        alert()->error(config('json-tip.category.update_error'));
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = array();
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Category::destroy($id);
            if ($result) {
                $data = [
                    'msg' => config('json-tip.category.destroy_success'),
                    'success' => true
                ];
            } else {
                $data = [
                    'msg' => config('json-tip.category.destroy_error'),
                    'success' => false
                ];
            }

        }
        return response()->json($data);
    }

    /**
     * 获取菜单下拉数据
     * @return array
     */
    private function getSelectDataTree()
    {
        $categorys = $this->categoryRepository->scopeQuery(function ($query) {
            return $query->where('is_show', 1)->withDepth();
        })->get();
        return $categorys;
    }

    /**
     * ajax更新菜单排序
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryOrder(Request $request)
    {
        $category = Category::findOrFail($request->get('id'));
        if ($category->update($request->all())) {
            $data = [
                'msg' => config('json-tip.category.update_success'),
                'success' => true
            ];
        } else {
            $data = [
                'msg' => config('json-tip.category.update_error'),
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
        $categorys = Category::where('title', 'like', '%' . trim($request->input('keywords')) . '%')
            ->orderBy('order', 'desc')
            ->get();
        return view('backend.category.index', compact('categorys'));
    }
}
