@extends('layout')
@section('banner')
    <div id="banner" class="jumbotron jumbotron-fluid"
         style="margin-top: 3rem;background: url({!! block(5) !!}) no-repeat center;background-size: auto 100%">
        <div class="app-container">
            <div class="container-fluid">
                <h3 class="text-success">从高质量的视频中学习Web 开发技术</h3>
                <p class="lead text-warning">PHP Laravel Vue.js 视频教程</p>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @include('themes.shop.common.me')
    <div class="col-lg-6 col-md-6">
        @foreach($posts as $v)
            <div class="app-card-list animal">
                <div class="card border-0 mb-4">
                    <img class="card-img-top" src="{{asset($v->thumb)}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-truncate"><a href="{{route('front.post.detail',['alias'=>$v->alias])}}" title="{{$v->title}}">{{$v->title}}</a></h5>

                        <p class="card-text app-card-icon font-weight-light">
                            <span class="mr-3"><i
                                        class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</span>
                            <span class="mr-3"><i
                                        class="fa fa-comment-o"></i> {{count($v->comments)>0?count($v->comments):'暂无评论'}}</span>
                            <span class="mr-3"><i class="fa fa-eye"></i> {{$v->views > 0 ? $v->views:'暂无访问记录'}}</span>
                            <span><i class="fa fa-file-o"></i> {{$v->category->title}}</span>
                        </p>
                        @if($v->tags->count())
                        <hr>
                        <p class="card-text">
                            <small class="text-muted">标签：</small>
                            @foreach($v->tags as $tag)
                                <a href="{{url('tag/'.$tag->name)}}" class="badge badge-light mr-2 text-muted">{{$tag->name}}</a>
                            @endforeach
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links('common.pagination')}}
    </div>
    @include('themes.shop.common.aside')
@endsection
