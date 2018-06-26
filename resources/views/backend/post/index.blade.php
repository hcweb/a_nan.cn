@extends('layout.backend')
@section('my-css')
    <style>
        .app-post-img-box {
            overflow: hidden;
            height: 200px;
        }

        .app-post-list .checkbox {
            margin-top: 0;
        }

        .app-post-list img {
            width: 100%;
            margin-top: 0;
            margin-bottom: 0;
            min-height: 200px;
            height: auto;
        }

        .app-icon-opacity {
            opacity: .5
        }
    </style>
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">文章管理</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->

        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('post.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加文章</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>
                            </button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i
                                        class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除
                            </button>
                        </div>
                    </div>
                    {!! Form::open(['route'=>'post.search']) !!}
                    <div class="col-sm-6 table-toolbar-right">
                        <div class="input-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                            <input placeholder="请输入标题名称查询" class="form-control" type="text" name="keywords">
                            <span class="input-group-btn">
					              <button class="btn btn-mint" type="submit">搜索</button>
					        </span>
                            @if($errors->has('keywords'))
                                @php
                                    alert()->error('erter',$errors->first('keywords'))
                                @endphp
                            @endif

                        </div>
                        {{--<div class="btn-group">--}}
                        {{--<button class="btn btn-default"><i class="demo-pli-download-from-cloud"></i></button>--}}
                        {{--<div class="btn-group dropdown">--}}
                        {{--<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">--}}
                        {{--<i class="demo-pli-gear"></i>--}}
                        {{--<span class="caret"></span>--}}
                        {{--</button>--}}
                        {{--<ul role="menu" class="dropdown-menu dropdown-menu-right">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                @foreach($posts as $v)
                    <div class="col-sm-4 col-md-3 col-xs-6">
                        <div class="panel pos-rel bg-gray-light bord-all app-post-list">
                            <div class="widget-control pad-no" style="width: 100%;">

                                <div class="btn-group dropdown pull-right">
                                    <a href="#" class="dropdown-toggle btn btn-trans color-light" data-toggle="dropdown"
                                       aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg text-warning"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="">
                                        <li><a href="{{route('post.edit',['id'=>$v->id])}}"><i
                                                        class="icon-lg icon-fw demo-psi-pen-5"></i> 编辑</a></li>
                                        <li><a href="javascript:;"
                                               onclick='deleteObj("{{URL::current()}}","{{$v->id}}","{{$v->title}}")'><i
                                                        class="icon-lg icon-fw demo-pli-recycling"></i> 删除</a></li>
                                        <li><a href="#"><i class="icon-lg icon-fw ti-eye"></i> 查看</a></li>
                                    </ul>
                                </div>
                                <div class="checkbox pull-left bg-light" style="padding: 3px 5px 5px 5px;">
                                    <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                           type="checkbox"
                                           value="{{$v->id}}" name="ids">
                                    <label for="demo-form-checkbox-{{$v->id}}"></label>
                                </div>
                            </div>
                            <div class="app-post-img-box">
                                <img alt="Profile Picture" class="img-lg  mar-ver" src="{{asset($v->thumb)}}">
                            </div>
                            <div class=" pad-all">
                                <p class="text-lg mar-no text-main" style="height: 40px;">
                                    <a href="{{route('post.edit',['id'=>$v->id])}}">{{str_limit($v->title,70)}}</a>
                                </p>
                                <p class="text-sm" style="height: 30px;">{{str_limit($v->alias,50)}}</p>
                                <p class="text-sm">
                                    <span class="pull-left app-icon-opacity"
                                          style="padding-top: 10px">{{$v->push_time}}</span>
                                    <span class="pull-right">
                                        <input type="text" class="form-control text-center" value="{{$v->order}}"
                                               style="width: 50px;"
                                               onblur='updateOrderById("{{route('post.update.order')}}","{{$v->id}}",this.value)'>
                                    </span>
                                </p>
                                <div class="clearfix"></div>
                                <div class="text-center pad-top">
                                    <div class="btn-group">
                                        @if($v->is_comment == true)
                                            <a href="javascript:;" onclick="setTuijian('is_comment',0,{{$v->id}})"
                                               class="btn btn-sm " title="取消评论"><i
                                                        class="ti-comment-alt icon-lg icon-fw text-info"></i></a>
                                        @else
                                            <a href="javascript:;" onclick="setTuijian('is_comment',1,{{$v->id}})"
                                               class="btn btn-sm " title="评论"><i
                                                        class="ti-comment-alt icon-lg icon-fw app-icon-opacity"></i></a>
                                        @endif

                                        @if($v->is_top == true)
                                            <a href="javascript:;" onclick="setTuijian('is_top',0,{{$v->id}})"
                                               class="btn btn-sm  "
                                               title="取消置顶"><i class="ti-arrow-up icon-lg icon-fw text-dander"></i></a>
                                        @else
                                            <a href="javascript:;" onclick="setTuijian('is_top',1,{{$v->id}})"
                                               class="btn btn-sm  "
                                               title="置顶"><i
                                                        class="ti-arrow-up icon-lg icon-fw app-icon-opacity"></i></a>
                                        @endif

                                        @if($v->is_tuijian == true)
                                            <a href="javascript:;" onclick="setTuijian('is_tuijian',0,{{$v->id}})"
                                               class="btn btn-sm  " title="取消推荐"><i
                                                        class="ti-thumb-up icon-lg icon-fw text-success"></i></a>
                                        @else
                                            <a href="javascript:;" onclick="setTuijian('is_tuijian',1,{{$v->id}})"
                                               class="btn btn-sm  " title="推荐"><i
                                                        class="ti-thumb-up icon-lg icon-fw app-icon-opacity"></i></a>
                                        @endif


                                        @if($v->is_hot == true)
                                            <a href="javascript:;" onclick="setTuijian('is_hot',0,{{$v->id}})"
                                               class="btn btn-sm  "
                                               title="取消热门"><i class="ti-medall icon-lg icon-fw text-warning"></i></a>
                                        @else
                                            <a href="javascript:;" onclick="setTuijian('is_hot',1,{{$v->id}})"
                                               class="btn btn-sm  "
                                               title="热门"><i class="ti-medall icon-lg icon-fw app-icon-opacity"></i></a>
                                        @endif

                                        @if($v->is_slide == true)
                                            <a href="javascript:;" onclick="setTuijian('is_slide',0,{{$v->id}})"
                                               class="btn btn-sm  " title="取消幻灯"><i
                                                        class="ti-gallery icon-lg icon-fw text-dark"></i></a>
                                        @else
                                            <a href="javascript:;" onclick="setTuijian('is_slide',1,{{$v->id}})"
                                               class="btn btn-sm  " title="幻灯"><i
                                                        class="ti-gallery icon-lg icon-fw app-icon-opacity"></i></a>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------->


                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="text-center">
                    {{$posts->links()}}
                </div>
            </div>
        </div>

        <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        function setTuijian(type, value, id) {
            $.post("{{route('post.type.order')}}", {
                id: id,
                _token: "{{csrf_token()}}",
                type: type,
                value: value
            }, function (response) {
                if (response.success == true){
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                }
            });
        }
    </script>
@endsection