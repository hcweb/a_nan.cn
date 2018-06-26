<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Repository\CommentRepository;
use App\Repository\MemberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GrahamCampbell\Markdown\Facades\Markdown;

class HomeController extends CommonController
{
    protected $commentRepository;
    protected $memberRepository;
    function __construct(CommentRepository $commentRepository,MemberRepository $memberRepository)
    {
        parent::__construct();
        $this->commentRepository=$commentRepository;
        $this->memberRepository=$memberRepository;
    }

    public function index()
    {
        //获取最新评论
        $comments=$this->commentRepository->scopeQuery(function ($query){
            return $query->where('state',1)->orderBy('created_at','desc')->limit(10);
        })->get();
        //获取最新注册用户
        $members=$this->memberRepository->scopeQuery(function ($query){
            return $query->where('state',1)->orderBy('created_at','desc')->limit(5);
        })->get();
        return view('backend.home.index',compact('comments','members'));
    }

    //清除缓存
    public function clearCache(){
        if (\Cache::clear()){
            alert()->success('缓存清除成功！');
        }else{
            alert()->error('缓存清除失败！');
        }
        return redirect()->route('login');
    }
}
