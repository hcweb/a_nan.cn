<header id="header">
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top pt-0 pb-0 shadow-sm">
        <a class="navbar-brand" href="/" style="padding: 0;"><i class="iconfont icon-a-nan-copy" style="font-size: 35px;color: #6bc30d;"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ active_class(if_uri('/')) }}">
                    <a class="nav-link pl-3 pr-3 header-a" href="/">首页</a>
                </li>
                @if($categorys->count())
                    @foreach($categorys as $v)
                        @if(count($v->children) > 0)
                            <li class="nav-item dropdown {{ active_class(if_uri($v->route)) }}">
                                <a class="nav-link dropdown-toggle pl-3 pr-3 header-a"
                                   href="{{$v->url != null ?$v->url :url($v->route)}}" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$v->title}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="app-header-dropdown">
                                    @foreach($v->children as $c)
                                        <a class="dropdown-item {{ active_class(if_uri($c->route)) }}"
                                           href="{{$c->url != null ? $c->url:url($c->route)}}">{{$c->title}}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{ active_class(if_uri($v->route)) }}">
                                <a class="nav-link pl-3 pr-3 header-a"
                                   href="{{$v->url != null ?$v->url :url($v->route)}}">{{$v->title}}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
            {{--<div class="btn-group" role="group" aria-label="">--}}
            {{--<a class="btn btn-success bor" role="button">登录</a>--}}
            {{--<a class="btn btn-secondary" role="button">注册</a>--}}
            {{--</div>--}}
        </div>
    </nav>
</header>