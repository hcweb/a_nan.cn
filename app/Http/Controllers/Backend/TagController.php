<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends CommonController
{

    public function index()
    {
        $tags = Tag::all();
        return view('backend.tag.index', compact('tags'));
    }


    /**
     * 创建和修改标签
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAndUpdateTag(TagRequest $request)
    {
        //修改
        if (!is_null($request->get('id'))) {
            $tag = Tag::findOrFail($request->get('id'));
            if ($tag->update($request->all())) {
                $data = [
                    'success' => true,
                    'message' => '标签修改成功^_^!',
                    'data' => $tag
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => '标签修改失败(꒦_꒦) !',
                ];
            }
        } else {
            //创建
            if ($reslut = Tag::create($request->all())) {
                $data = [
                    'success' => true,
                    'message' => '标签创建成功^_^!',
                    'data' => $reslut
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => '标签创建失败(꒦_꒦)!'
                ];
            }
        }
        return response()->json($data);
    }


    /**
     * 删除标签
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Tag::destroy($id);
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

}
