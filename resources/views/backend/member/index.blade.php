@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">会员列表</h3>
        </div>
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left"><a href="//fruit.cc/backend/post/create"
                                                                class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加会员</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>
                            </button>
                            <button class="btn btn-default"
                                    onclick="deleteMoreObject(&quot;//fruit.cc/backend/post&quot;)"><i
                                        class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除
                            </button>
                        </div>
                    </div>
                    <form method="POST" action="//fruit.cc/backend/post/search" accept-charset="UTF-8"><input
                                name="_token" value="Yi9lUGyrRdxlAOftq0wfCGVVm4fhNKCsPs76Eys0" type="hidden">
                        <div class="col-sm-6 table-toolbar-right">
                            <div class="input-group "><input placeholder="请输入标题名称查询" class="form-control"
                                                             name="keywords" type="text"><span class="input-group-btn"><button
                                            class="btn btn-mint" type="submit">搜索</button></span></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if(count($members) > 0)
                    @foreach($members as $v)
                        <div class="col-sm-4 col-md-2">
                            <!-- Contact Widget -->
                            <!---------------------------------->
                            <div class="panel pos-rel bg-gray-light">
                                <div class="pad-all text-center">
                                    <div class="widget-control">
                                        <div class="btn-group dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown"
                                               aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right" style="">
                                                <li><a href="#"><i class="icon-lg icon-fw demo-psi-pen-5"></i> 编辑</a>
                                                </li>
                                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i>
                                                        删除</a></li>
                                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i>
                                                        发送邮件</a>
                                                </li>
                                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> 锁定</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <img alt="Profile Picture" class="img-lg img-circle mar-ver"
                                             src="{{$v->avatar}}">
                                        <p class="text-lg text-semibold mar-no text-main">{{$v->name}}</p>
                                    </a>
                                    <div class="pad-top btn-group">
                                        <a href="#" class="btn btn-default fa fa-envelope icon-lg add-tooltip" data-original-title="{{$v->email}}" data-container="body"></a>
                                        <a href="#" class="btn btn-default  fa {{$v->platform=='qq'?'fa-qq':'fa-github'}} icon-lg add-tooltip" data-original-title="{{$v->platform}}" data-container="body" aria-describedby="tooltip570111"></a>
                                        <a href="#" class="btn btn-default fa fa-address-card icon-lg add-tooltip" data-original-title="{{$v->visitor}}" data-container="body"></a>
                                        <a href="#" class="btn btn-default fa fa-calendar icon-lg add-tooltip" data-original-title="{{$v->created_at}}" data-container="body"></a>
                                    </div>
                                </div>
                            </div>
                            <!---------------------------------->


                        </div>
                    @endforeach
                @else
                    <p>暂无数据</p>
                @endif
            </div>
            <div class="row">
                <div class="text-center">
                    {{$members->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection