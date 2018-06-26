@extends('layout')
@section('banner')
    <div class="subscribe-line subscribe-line-image app-banner-height"
         style='background: url("{{asset($post->thumb)}}") no-repeat center top;background-size: 100% auto;-moz-background-size: 100% auto;-webkit-background-size: 100% auto;'>
        <div class="container">
            <div class="row">
                <div class="col-md-7 ml-auto mr-auto">
                    <div class="text-center">
                        <h3 class="title">{{$post->title}}</h3>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">{{$post->source}}</button>
                            <button type="button" class="btn btn-primary">{{$post->category->title}}</button>
                        </div>
                        <p class="description card-sub-description">
                            <span><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                            <span><i class="fa fa-comment-o"></i> {{count($post->comments)>0?count($post->comments):'暂无评论'}}</span>
                            <span><i class="fa fa-eye"></i> {{$post->views > 0 ? $post->views:'暂无访问记录'}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-9 ml-auto mr-auto">
        <p>{!! $post->description !!}</p>

        <div>
            <div v-cloak v-if="showMessage == true" class="alert alert-success" role="alert">
                <div class="container">
                    <div class="alert-icon">
                        <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    @{{message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  						<span aria-hidden="true">
							<i class="now-ui-icons ui-1_simple-remove"></i>
						</span>
                    </button>
                </div>
            </div>
            <div v-cloak v-if="showMessage == false" class="alert alert-danger" role="alert">
                <div class="container">
                    <div class="alert-icon">
                        <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    @{{message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  						<span aria-hidden="true">
							<i class="now-ui-icons ui-1_simple-remove"></i>
						</span>
                    </button>
                </div>
            </div>
            <h4 class="title">{{count($post->comments)}}条评论</h4>
            @if(auth()->guard('member')->check())
                <div class="app-comment-box">
                    <span>
                        <img src="{{auth()->guard('member')->user()->avatar}}" alt="" class="rounded-circle">
                        <small class="text-info text-md-center">{{auth()->guard('member')->user()->name}}</small>
                    </span>
                    <div class='app-textarea-box' :class="{'active':showSendBtn}">
                    <textarea rows="5" class="form-control rounded" id="content" name="content"
                              v-model="commentBody" v-on:focus="showBtn" v-on:blur="hiddenBtn"></textarea>
                    </div>

                    <div v-cloak v-show="showSendBtn" class="comment-icons">
                        <i class="fa fa fa-smile-o pull-left emotion app-icon-smile"></i>
                        <button class="btn btn-primary pull-right" v-on:click="saveComment"><i
                                    class="now-ui-icons ui-1_send"></i> 发布
                        </button>
                    </div>
                </div>
            @else
                <div class="app-comment-box">
                    <span>
                        <img src="{!! theme_url('img/default.gif') !!}" alt="" class="rounded-circle">
                        <small v-cloak class="text-info text-md-center" v-text="userTmpName"></small>
                    </span>
                    <div class='app-textarea-box' :class="{'active':addActive}">
                    <textarea rows="5" class="form-control rounded" id="content" name="content"
                              v-model="commentBody" v-on:focus="showBtn" v-on:blur="hiddenBtn"></textarea>
                    </div>

                    <div v-cloak v-show="showSendBtn" class="comment-icons">
                        <div class="loginBtn pull-right">
                            <button class="btn btn-primary pull-right" v-on:click="loginShowPopover"><i
                                        class="fa fa-login"></i> 请先登录后评论
                            </button>
                            <div v-cloak v-if="showPopover" class="popover fade bs-popover-left show" role="tooltip"
                                 x-placement="left">
                                <div class="arrow" style="top: 38px;"></div>
                                <h3 class="popover-header">请选择登录方式</h3>
                                <div class="popover-body">
                                    <a href="{{url('/oauth/github')}}" class="btn btn-dark btn-block"
                                       style="margin-top: 0"><i class="fa fa-github"> github登录</i></a>
                                    <a href="" class="btn btn-info btn-block"><i class="fa fa-qq"> qq登录</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="clearfix"></div>
            <div class="media-area mar-top">
                @foreach($post->comments->toTree() as $v)
                    <div class="media">
                        <a class="pull-left" href="#pablo">
                            <div class="avatar">
                                <img class="media-object rounded-circle" src="{{$v->member->avatar}}" alt="...">
                            </div>
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading">
                                {{$v->title}}
                                <label class="text-info text-muted"
                                       style="font-size:14px;margin-right:10px;">{{$v->member->name}}</label>
                                <small class="text-muted" style="margin-right:10px;">{{$v->visitor}}</small>
                                <small class="text-muted">{{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</small>
                            </h5>
                            <p>{!! $v->content !!}</p>

                            <div class="media-footer">
                                <a href="#content" v-on:click="replay({{$v->id}})"
                                   class="btn btn-primary btn-neutral pull-right"
                                   style="background: none;" rel="tooltip" title=""
                                   data-original-title="回复该评论">
                                    <i class="now-ui-icons ui-1_send"></i> 回复
                                </a>
                            </div>

                            @if(count($v->children) > 0)
                                @foreach($v->children as $c)
                                    <div class="media">
                                        <a class="pull-left" href="#pablo">
                                            <div class="avatar">
                                                <img class="media-object rounded-circle" src="{{$c->member->avatar}}"
                                                     alt="...">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h5 class="media-heading">
                                                {{$v->title}}
                                                <label class="text-info text-muted"
                                                       style="font-size:14px;margin-right:10px;">{{$v->member->name}}</label>
                                                <small class="text-muted"
                                                       style="margin-right:10px;">{{$v->visitor}}</small>
                                                <small class="text-muted">{{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</small>
                                            </h5>
                                            <p>{!! $v->content !!}</p>

                                            <div class="media-footer">
                                                <a href="#content" v-on:click="replay({{$v->id}})"
                                                   class="btn btn-primary btn-neutral pull-right"
                                                   style="background: none;" rel="tooltip" title=""
                                                   data-original-title="回复该评论">
                                                    <i class="now-ui-icons ui-1_send"></i> 回复
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('common.aside')
@endsection
@section('my-js')
    <script src="{{asset('static/vue/vue.js')}}"></script>
    <script src="{{asset('static/vue/axios.min.js')}}"></script>
    <script src="{{asset('static/qqFace/js/jquery.qqFace.js')}}"></script>
    <script src="https://cdn.bootcss.com/jquery-browser/0.1.0/jquery.browser.min.js"></script>
    <script type="text/javascript">
        var app = new Vue({
            el: '#my-app',
            data: {
                userTmpName: '雁过留名',
                commentBody: '',
                showPopover: false,
                showSendBtn: false,
                addActive: false,
                message: '',
                showMessage: null,
                parentId: null
            },
            methods: {
                sendShowPopover: function () {
                    if (this.commentBody != '' && this.commentBody.length >= 10) {
                        this.showPopover = true;
                    } else {
                        alert('阿斯顿发顺丰大额');
                    }
                },
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
                            app.showMessage = response.data.success;
                            app.message = response.data.msg;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                sendCommentAjax: function () {

                },
                cancleCommentAjax: function () {
                    this.showPopover = false;
                },
                showBtn: function () {
                    this.addActive = true;
                    this.showSendBtn = true
                },
                hiddenBtn: function () {
                    this.addActive = false;
                },
                loginShowPopover: function () {
                    this.showPopover = true;
                },
                replay: function (id) {
                    this.parentId = id;
                }
            },
            watch: {}
        });
        $(function () {
            $('.emotion').qqFace(
                {
                    id: 'facebox',
                    assign: 'content',
                    path: "{{asset('static/qqFace/arclist')}}" + "/"
                }
            )
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
