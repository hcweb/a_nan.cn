<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends BaseController
{
    protected $repository;
    function __construct(CommentRepository $commentRepository)
    {
        $this->repository=$commentRepository;
    }

    /**
     * 保存评论信息
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request){
        $result=$this->repository->create($request->all());
        return response()->json($result);
    }
}
