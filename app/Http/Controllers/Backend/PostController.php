<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\CommonController;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Illuminate\Http\Request;

class PostController extends CommonController
{
    protected $categoryRepository;
    protected $postRepository;
    function __construct(CategoryRepository $categoryRepository,PostRepository $postRepository)
    {
        parent::__construct();
        $this->categoryRepository=$categoryRepository;
        $this->postRepository=$postRepository;
    }

    /**
     * 分类首页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->postRepository->orderBy('order', 'desc')->paginate(12);
        return view('backend.post.index', compact('posts'));
    }


    /**
     * 菜单创建页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $treeMenu = $this->getSelectDataTree();
        $tags = $this->getTags();
        return view('backend.post.create', compact('treeMenu', 'tags'));
    }


    /**
     * 保存菜单
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        if ($post = $this->postRepository->create($request->except('tags'))) {
            $post->syncTags($request->get('tags', []));
            alert()->success('文章创建成功!');
            return redirect()->route('post.index');
        } else {
            alert()->error('文章创建失败!');
            return redirect()->back();
        }
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
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post=$this->postRepository->find($post->id);
        $treeMenu = $this->getSelectDataTree();
        $tags = $this->getTags();
        $result=array();
        foreach ($post->tags as $v){
            array_push($result,$v->name);
        }
        $activeTags=implode(",",$result);
        return view('backend.post.edit', compact('post', 'treeMenu','tags','activeTags'));
    }


    /**
     * 更新菜单
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        !is_null(request()->get('is_slide')) ? $post->is_slide = 1 : $post->is_slide = 0;
        !is_null(request()->get('is_top')) ? $post->is_top = 1 : $post->is_top = 0;
        !is_null(request()->get('is_hot')) ? $post->is_hot = 1 : $post->is_hot = 0;
        !is_null(request()->get('is_tuijian')) ? $post->is_tuijian = 1 : $post->is_tuijian = 0;
        !is_null(request()->get('is_comment')) ? $post->is_comment = 1 : $post->is_comment = 0;
        if ($post->update($request->except('tags'))) {
            $post->syncTags($request->get('tags', []));
            alert()->success('文章更新成功!');
            return redirect()->route('post.index');
        } else {
            alert()->error('文章更新失败!');
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
            $result = Post::destroy($id);
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
    public function postUpdateOrder(Request $request)
    {
        $category = Post::findOrFail($request->get('id'));
        if ($category->update($request->all())) {
            $data = [
                'msg' => '文章排序更新成功!',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '文章排序更新失败!',
                'success' => false
            ];
        }
        return response()->json($data);
    }

    /**
     * ajax设置推荐类型
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateTuiJianType(Request $request)
    {
        $post = Post::findOrFail($request->get('id'));
        $type = $request->get('type');
        $post->$type = $request->get('value');
        if ($post->save()) {
            $data = [
                'msg' => '推荐类型设置成功!',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '推荐类型设置失败!',
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
        $posts = Post::where('title', 'like', '%' . trim($request->input('keywords')) . '%')
            ->orderBy('order', 'desc')
            ->paginate(12);
        return view('backend.post.index', compact('posts'));
    }

    /**
     * 获取所有标签
     * @return array
     */
    private function getTags()
    {
        $tags = \DB::table('tags')->pluck('name')->toArray();
        $result = [];
        foreach ($tags as $tag) {
            array_push($result, [$tag => $tag]);
        }
        return array_collapse($result);
    }
}
