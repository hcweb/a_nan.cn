@extends('layout.backend')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-warning panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-file-word icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
                    <p class="text-2x mar-no text-semibold">241</p>
                    <p class="mar-no">文章</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-file-zip icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
                    <p class="text-2x mar-no text-semibold">241</p>
                    <p class="mar-no">留言</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-mint panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-camera-2 icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
                    <p class="text-2x mar-no text-semibold">241</p>
                    <p class="mar-no">会员</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-danger panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-video icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
                    <p class="text-2x mar-no text-semibold">241</p>
                    <p class="mar-no">评论</p>
                </div>
            </div>
        </div>

    </div>
    {{--<div class="panel">--}}

        {{--<div class="panel-heading">--}}
            {{--<h3 class="panel-title">站点信息</h3>--}}
        {{--</div>--}}
        {{--<div class="panel-body">--}}
            {{--<ul class="list-unstyled">--}}
                {{--<li class="col-xs-4 col-md-4">站点名称：DTcms内容管理系统</li>--}}
                {{--<li class="col-xs-4 col-md-4">公司名称：深圳市动力启航软件有限公司</li>--}}
                {{--<li class="col-xs-4 col-md-4">主站域名：http://demo.dtcms.net</li>--}}

                {{--<li class="col-xs-4 col-md-4">安装目录：/</li>--}}
                {{--<li class="col-xs-4 col-md-4">网站管理目录：admin</li>--}}
                {{--<li class="col-xs-4 col-md-4">附件上传目录：upload</li>--}}

                {{--<li class="col-xs-4 col-md-4">服务器名称：AY130518163619Z</li>--}}
                {{--<li class="col-xs-4 col-md-4">服务器IP：121.199.8.204</li>--}}
                {{--<li class="col-xs-4 col-md-4">NET框架版本：4.0.30319.1008</li>--}}

                {{--<li class="col-xs-4 col-md-4">操作系统：Microsoft Windows NT 5.2.3790 Service Pack 2</li>--}}
                {{--<li class="col-xs-4 col-md-4">IIS环境：Microsoft-IIS/6.0</li>--}}
                {{--<li class="col-xs-4 col-md-4">服务器端口：80</li>--}}

                {{--<li class="col-xs-4 col-md-4">目录物理路径：D:\web\wwwroot\dtcmsdemo5\</li>--}}
                {{--<li class="col-xs-4 col-md-4">系统版本：V5.0.0</li>--}}
                {{--<li class="col-xs-4 col-md-4">版本更新：点击升级5.0</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-message"></i>最新留言</h3>
                </div>
                <div class="panel-body" style="padding-top: 0">
                    <div class="table-responsive">
                        <table class="table table-striped" style="margin-bottom: 0">
                            <thead>
                            <tr>
                                <th>作者</th>
                                <th>内容</th>
                                <th>城市</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $v)
                                <tr>
                                    <td><a href="#" style="padding-top: 3px;padding-bottom: 3px;display: inline-block" class="text-info">{{$v->member->name}}</a></td>
                                    <td>{!! $v->content !!}</td>
                                    <td>{{$v->city}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-message"></i>最新会员</h3>
                </div>
                <div class="panel-body" style="padding-top: 0">
                    <div class="table-responsive">
                        <table class="table table-striped"  style="margin-bottom: 0">
                            <thead>
                            <tr>
                                <th>图像</th>
                                <th>昵称</th>
                                <th>来源</th>
                                <th>注册时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $v)
                                <tr>
                                    <td><img src="{{$v->avatar}}" alt="" class="img-xs img-circle"></td>
                                    <td class="text-info">{{$v->name}}</td>
                                    <td>{{$v->platform}}</td>
                                    <td>{{$v->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script src="{{asset('backend/js/demo/nifty-demo.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/dashboard.js')}}"></script>
@endsection

@section('my-css')
    {{--<link href="{{asset('backend/plugins/pace/pace.min.css')}}" rel="stylesheet">--}}
    {{--<script src="{{asset('backend/plugins/pace/pace.min.js')}}"></script>--}}
@endsection
