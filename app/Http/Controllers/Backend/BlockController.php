<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BlockRequest;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends CommonController
{

    public function index()
    {
        $blocks = Block::latest()->paginate(10);
        return view('backend.block.index', compact('blocks'));
    }

    /**
     *创建资料
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.block.create');
    }

    /**
     * 保存资料
     * @param  BlockRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockRequest $request)
    {
        $data = [
            'title' => $request->get('title'),
            'type' => $request->get('type'),
            'body' => array_get($request->get('body'), $request->get('type'))
        ];
        if (Block::create($data)) {
            alert()->success(config('json-tip.block.create_success'));
            return redirect()->route('block.index');
        }
        alert()->error(config('json-tip.block.create_error'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        $block = Block::findOrFail($block->id);
        $block->body = [$block->type => $block->body];
        return view('backend.block.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block)
    {
        $request->merge(['body' => $request->get('body')[$request->get('type')]]);
        if ($block->update($request->except('file', '_token'))) {
            alert()->success(config('json-tip.block.update_success'));
            return redirect()->route('block.index');
        }
        alert()->error(config('json-tip.block.update_error'));
        return redirect()->back();
    }

    /**
     * 删除资料
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data=array();
        if ($id) {
            if (str_contains($id, ',')) {
                $id = explode(',', $id);
            }
            $result = Block::destroy($id);
            if ($result) {
                $data = [
                    'msg' => config('json-tip.block.destroy_success'),
                    'success' => true
                ];
            } else {
                $data = [
                    'msg' => config('json-tip.block.destroy_error'),
                    'success' => false
                ];
            }

        }
        return response()->json($data);
    }

    /**
     * 删除图片的时候更新资料信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBodyById()
    {
        $block = Block::findOrFail(request()->get('id'));
        $block->body = request()->get('body');
        if ($block->save()) {
            $data = [
                'msg' => config('json-tip.block.update_success'),
                'success' => true
            ];
        } else {
            $data = [
                'msg' => config('json-tip.block.update_error'),
                'success' => false
            ];
        }
        return response()->json($data);
    }
}
