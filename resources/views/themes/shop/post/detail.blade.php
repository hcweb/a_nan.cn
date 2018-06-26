@extends('layout')
@section('title')
    {{$post->title}}
@endsection
@section('my-css')
    <style>
        .app-aside {
            margin-top: -10rem;
        }

        #hot-article .rounded-circle {
            display: none;
        }
    </style>
@endsection
@section('banner')
    <div class="app-banner-height position-relative"
         style='background: url("{{asset($post->thumb)}}") no-repeat center top;background-size: 100% 100%;-moz-background-size: 100% 100%;-webkit-background-size: 100% auto;'>
        <div class="app-mark"></div>
        <div class="app-container position-relative">
            <div class="row  ml-0 mr-0">
                <div class="col-lg-9 col-md-9">
                    <div class="ml-auto mr-auto">
                        <div class="text-left" style="padding-top: 6rem;">
                            <h3 class="title text-light">{{$post->title}}</h3>
                            <div class="btn-group pt-2 pb-2 btn-group-sm">
                                <button type="button" class="btn btn-success">{{$post->source}}</button>
                                <button type="button"
                                        class="btn btn-dark">{{$post->category->title}}</button>
                            </div>
                            <p class="description card-sub-description text-light">
                                <span class="pr-2"><i
                                            class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                                <span class="pr-2"><i
                                            class="fa fa-comment-o"></i> {{count($post->comments)>0?count($post->comments):'暂无评论'}}</span>
                                <span class="pr-2"><i
                                            class="fa fa-eye"></i> {{$post->views > 0 ? $post->views:'暂无访问记录'}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-9 col-md-9 mb-3">
        <div class="row">
            <nav class="breadcrumb bg-transparent">
                您现在的位置:
                <a class="breadcrumb-item" href="/">首页</a>
                <a class="breadcrumb-item" href="{{url('category')}}">{{$post->category->ancestorsOf($post->category->id)[0]->title}}</a>
                <a class="breadcrumb-item" href="{{url('category/'.$post->category->title)}}">{{$post->category->title}}</a>
                <span class="breadcrumb-item active">{{$post->title}}</span>
            </nav>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="card-text">
                    <div id="post-content">
                        {!! $post->description !!}
                    </div>
                    @if($post->tags->count())
                    <p>
                        <small class="text-muted">所属标签:</small>
                        @foreach($post->tags as $tag)
                            <a href="{{url('tag/'.$tag->name)}}" class="badge badge-light mr-2 text-muted">{{$tag->name}}</a>
                        @endforeach
                    </p>
                        @endif
                </div>
                <hr>
                <p>上一篇：
                @if($post->pre)
                   <a href="{{url('post/'.$post->pre->alias)}}">{{$post->pre->title}}</a>
                @else
                        <span class="text-black-50">没有上一篇了</span>
                @endif
                <p>下一篇：
                    @if($post->next)
                        <a href="{{url('post/'.$post->next->alias)}}">{{$post->next->title}}</a>
                    @else
                        <span class="text-black-50">没有下一篇了</span>
                    @endif
                </p>
                <hr>

                <h4 class="position-relative app-comment-title mt-4 mb-4">评论
                    <small class="text-muted">「{{count($post->comments)}}」</small>
                </h4>
                <div class="media mb-5">
                    @if(auth()->guard('member')->check())
                        <div class="mr-3 text-center" style="width: 3rem;height: 4rem;">
                            <img class="rounded" src="{{auth()->guard('member')->user()->avatar}}"
                                 alt="Generic placeholder image"
                                 style="width: 3rem;height: 3rem;">
                            <small class="text-warning">{{auth()->guard('member')->user()->name}}</small>
                        </div>
                    @else
                        <img class="mr-3 rounded" src="{!! theme_url('img/default.gif') !!}"
                             alt="Generic placeholder image"
                             style="width: 3rem;height: 3rem;">
                    @endif
                    <div class="media-body position-relative">
                        @if(auth()->guard('member')->check())
                            <textarea class="form-control" name="content" id="content" v-model="commentBody"></textarea>
                            <i class="fa fa fa-smile-o pull-left emotion app-icon-smile"></i>
                            <button class="btn btn-success rounded float-right btn-sm mt-3" v-on:click="saveComment">
                                发表评论
                            </button>
                        @else
                            <textarea class="form-control" readonly>请登录后，发表评论</textarea>
                            <button class="btn btn-success rounded float-right btn-sm mt-3" v-on:click="showLogin">
                                发表评论
                            </button>
                            <div v-bind:class='{show:isShowLogin == true}' role="tooltip" x-placement="left"
                                 class="popover bs-popover-left shadow-lg app-popover">
                                <div class="arrow"></div>
                                <h5 class="popover-header bg-white text-muted">请选择登录方式</h5>
                                <div class="popover-body">
                                    <a href="{{url('/oauth/github')}}"
                                       class="btn btn-dark btn-block">
                                        <i class="fa fa-github"> github登录</i></a>
                                    <a href="{{url('/oauth/qq')}}" class="btn btn-info btn-block">
                                        <i class="fa fa-qq"> qq登录</i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @include('comment.list',['comments'=>$post->comments->toTree()])
            </div>
        </div>
    </div>
    @include('common.aside')
@endsection
@section('my-js')
    <script src="{{asset('static/vue/vue.js')}}"></script>
    <script src="{{asset('static/vue/axios.min.js')}}"></script>
    <script src="{{asset('static/qqFace/js/jquery.qqFace.js')}}"></script>
    {!! Theme::js('js/jquery.browser.min.js') !!}
    <script type="text/javascript">
        var app = new Vue({
            el: '#my-app',
            data: {
                isShowLogin: false,
                commentBody: '',
                parentId:null
            },
            methods: {
                saveComment: function () {
                    axios({
                        method: 'POST',
                        url: "{{route('front.comment.save')}}",
                        data: {
                            content: replace_em(this.commentBody),
                            cPostId: "{{$post->id}}",
                            parentId: this.parentId,
                            _token: "{{csrf_token()}}"
                        }
                    })
                        .then(function (response) {
                            console.log(response);
                            if (response.data.success == true) {
                                swal({
                                    title: '',
                                    text: response.data.msg,
                                    type: 'success',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                setTimeout(function () {
                                    window.location.href = window.location.href;
                                }, 2000);

                            } else {
                                swal({
                                    title: '',
                                    text: response.data.message,
                                    type: 'error',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
                            }


                        })
                        .catch(function (error) {
                            swal({
                                title: '',
                                text: error.response.data.errors.content,
                                type: 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        });
                },
                showLogin: function () {
                    this.isShowLogin = !this.isShowLogin;
                },
                reply:function (id) {
					this.parentId=id;
                    $("#content").focus();
                }
            }
        });
        $(function () {
            @if(auth()->guard('member')->check())
            $('.emotion').qqFace(
                {
                    id: 'facebox',
                    assign: 'content',
                    path: "{{asset('static/qqFace/arclist')}}" + "/"
                }
            );
            @endif
        });
        function replace_em(str) {
            str = str.replace(/\</g, '&lt;');
            str = str.replace(/\>/g, '&gt;');
            str = str.replace(/\n/g, '<br/>');
            str = str.replace(/\[em_([0-9]*)\]/g, '<img src="/static/qqFace/arclist/$1.gif" border="0" />');
            return str;
        }
    </script>
@endsection
