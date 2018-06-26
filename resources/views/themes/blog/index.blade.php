@extends('layout')
@section('banner')
    <div class="subscribe-line subscribe-line-image">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="text-center">
                        <h4 class="title">订阅我们的新闻</h4>
                        <p class="description">
                            加入我们的通讯并每周在您的收件箱中收到新闻！我们也讨厌垃圾邮件，所以不用担心
                        </p>
                    </div>

                    <div class="card card-raised card-form-horizontal">
                        <div class="card-body">
                            <form method="" action="">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                        class="fa fa-search"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="查找您需要的内容">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn-round btn-block">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-9 ml-auto mr-auto">
        <h3 class="title">最新博文</h3>
        @foreach($posts as $v)
            <div class="card card-plain card-blog">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-image">
                            <img class="img rounded" src="{{asset($v->thumb)}}">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="card-title">
                            <a href="{{route('front.post.detail',['alias'=>$v->alias])}}">{{$v->title}}</a>
                        </h4>
                        <p class="card-sub-description">
                            <span><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</span>
                            <span><i class="fa fa-comment-o"></i> {{count($v->comments)>0?count($v->comments):'暂无评论'}}</span>
                            <span><i class="fa fa-eye"></i> {{$v->views > 0 ? $v->views:'暂无访问记录'}}</span>
                            <span><i class="fa fa-file-o"></i> {{$v->category->title}}</span>
                        </p>
                        <p class="card-description">
                            {{str_limit($v->summary)}}
                        </p>
                    </div>
                    <div class="col-md-12">
                            <span class="pull-left app-post-tags">
                                <i class="fa fa-bookmark-o"></i>
                                @foreach($v->tags as $tag)
                                    <a href="#">{{$tag->name}}</a>
                                @endforeach
                            </span>
                        <span class="pull-right">
                                <a href="{{route('front.post.detail',['alias'=>$v->alias])}}" class="btn btn-primary btn-simple btn-round">Read More</a>
                            </span>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links('common.pagination')}}
    </div>
    @include('common.aside')
@endsection
