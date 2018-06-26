<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LinkRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Link;
use App\Models\LinkItem;
use Illuminate\Http\Request;

class LinkController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkCates = Link::all();
        $links = LinkItem::orderBy('order', 'desc')->paginate(5);
        return view('backend.link.index', compact('links', 'linkCates'));
    }

    /**
     * 创建
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $linkCate = $this->getLinkCate();
        return view('backend.link.create', compact('linkCate'));
    }

    /**
     * 保存信息
     * @param LinkRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LinkRequest $request)
    {
        if (LinkItem::create($request->all())) {
            alert()->success('友情链接添加成功!');
            return redirect()->route('link.index');
        } else {
            alert()->error('友情链接添加失败!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * 编辑友情链接
     * @param LinkItem $link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LinkItem $link)
    {
        $link = LinkItem::findOrFail($link->id);
        $linkCate = $this->getLinkCate();
        return view('backend.link.edit', compact('linkCate', 'link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LinkRequest $request
     * @param  \App\Models\LinkItem $link
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, LinkItem $link)
    {
        if ($link->update($request->all())) {
            alert()->success('友情链接更新成功!');
            return redirect()->route('link.index');
        } else {
            alert()->error('友情链接更新失败!');
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
            $result = LinkItem::destroy($id);
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
     * 获取友情链接分类
     * @return mixed
     */
    private function getLinkCate()
    {
        return Link::pluck('name', 'id');
    }

    /**
     * 删除分类
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyLinkCategory($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Link::destroy($id);
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
     * 创建和修改友情链接分类
     * @return \Illuminate\Http\JsonResponse
     */
    public function createLinkCategory()
    {
        if (!is_null(request()->get('id'))) {
            $link = Link::findOrFail(request()->get('id'));
            if ($link->update(request()->all())) {
                $data = [
                    'success' => true,
                    'message' => '分类修改成功^_^!',
                    'data' => $link
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => '分类修改失败(꒦_꒦) !'
                ];
            }
        } else {
            if ($reslut = Link::create(request()->all())) {
                $data = [
                    'success' => true,
                    'message' => '分类创建成功^_^!',
                    'data' => $reslut
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => '分类创建失败(꒦_꒦)!'
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * ajax更新菜单排序
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function linkUpdateOrder(Request $request)
    {
        $link = LinkItem::findOrFail($request->get('id'));
        $link->order = $request->get('order');
        if ($link->save()) {
            $data = [
                'msg' => '友情链接排序更新成功!',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '友情链接文章排序更新失败!',
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
        $linkCates = Link::all();
        $links = LinkItem::where('title', 'like', '%' . trim($request->input('keywords')) . '%')
            ->orderBy('order', 'desc')
            ->paginate(5);
        return view('backend.link.index', compact('links', 'linkCates'));
    }
}
