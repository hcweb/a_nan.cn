@extends('layout')
@section('title')

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
         style='background: url("{{asset('static/img/default_bg.jpg')}}") no-repeat center top;background-size: 100% auto;-moz-background-size: 100% auto;-webkit-background-size: 100% auto;'>
        <div class="app-mark"></div>
        <div class="app-container position-relative">
            <div class="row  ml-0 mr-0">
                <div class="col-lg-9 col-md-9">
                    <div class="ml-auto mr-auto">
                        <div class="text-left" style="padding-top: 6rem;">
                            @isset($category)
                            <h3 class="title text-light">{{$category->title}}</h3>
                            @endisset

                            @isset($tag)
                                    <h3 class="title text-light">{{$tag->name}}</h3>
                            @endisset
                            {{--<div class="btn-group pt-2 pb-2 btn-group-sm">--}}
                            {{--<button type="button" class="btn btn-success">{{$post->source}}</button>--}}
                            {{--<button type="button"--}}
                            {{--class="btn btn-dark">{{$post->category->title}}</button>--}}
                            {{--</div>--}}
                            {{--<p class="description card-sub-description text-light">--}}
                            {{--<span class="pr-2"><i--}}
                            {{--class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>--}}
                            {{--<span class="pr-2"><i--}}
                            {{--class="fa fa-comment-o"></i> {{count($post->comments)>0?count($post->comments):'暂无评论'}}</span>--}}
                            {{--<span class="pr-2"><i--}}
                            {{--class="fa fa-eye"></i> {{$post->views > 0 ? $post->views:'暂无访问记录'}}</span>--}}
                            {{--</p>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-9 col-md-9">
        @foreach($category->ancestors as $i => $cat)
            <small> {{$category->ancestors->count() ? implode(' > ', $category->ancestors->pluck('title')->toArray()) : 'Top Level'}} </small>
            {{$category->title}}
        @endforeach
        @if($posts->count())
        <div class="card border-0">
            <div class="card-body">
                <ul class="list-unstyled" id="app-post-list">
                    @foreach($posts as $v)
                        <li class="media mb-4 pb-4">
                            <img class="mr-3 img-fluid" src="{{asset($v->thumb)}}" alt="Generic placeholder image"
                                 style="width:12rem;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><a href="{{route('front.post.detail',['alias'=>$v->alias])}}">{{$v->title}}</a></h5>
                                <p class="text-muted mt-2 mb-0">
                                {{str_limit($v->summary,150)}}
                                <a href="" class="text-right">查看详情</a>
                                </p>
                                <div class="row mt-2">
                                 <p class="app-card-icon font-weight-light  mb-0 col-lg-6 col-md-6">
                                    <span class="mr-3"><i
                                                class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</span>
                                    <span class="mr-3"><i
                                                class="fa fa-comment-o"></i> {{count($v->comments)>0?count($v->comments):'暂无评论'}}</span>
                                    <span class="mr-3"><i class="fa fa-eye"></i> {{$v->views > 0 ? $v->views:'暂无访问记录'}}</span>
                                    <span><i class="fa fa-file-o"></i> {{$v->category->title}}</span>
                                </p>
                                @if (count($v->tags) > 0)
                                    <p class=" mb-0 col-lg-6 col-md-6 text-right">
                                    <small class="text-muted">标签：</small>
                                    @foreach($v->tags as $tag)
                                        <a href="#" class="badge badge-light mr-2 text-muted">{{$tag->name}}</a>
                                    @endforeach
                                </p> 
                                @endif
                               
                                </div> 
                                
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-4">
            {{$posts->links('common.pagination')}}
        </div>
            @else
            123
        @endif
    </div>
    @include('common.aside')
@endsection

