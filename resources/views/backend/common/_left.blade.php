<nav id="mainnav-container">
    <div id="mainnav">
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="{{asset(auth()->user()->avatar)}}" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            {{--<span class="pull-right dropdown-toggle">--}}
                                                {{--<i class="dropdown-caret"></i>--}}
                                            {{--</span>--}}
                                <p class="mnp-name">欢迎回来{{auth()->user()->name}}</p>
                                <span class="mnp-desc">{{auth()->user()->email}}</span>
                            </a>
                        </div>
                        {{--<div id="profile-nav" class="collapse list-group bg-trans">--}}
                            {{--<a href="#" class="list-group-item">--}}
                                {{--<i class="demo-pli-male icon-lg icon-fw"></i>基本信息--}}
                            {{--</a>--}}
                            {{--<a href="#" class="list-group-item">--}}
                                {{--<i class="demo-pli-gear icon-lg icon-fw"></i>设置--}}
                            {{--</a>--}}
                            {{--<a href="#" class="list-group-item">--}}
                                {{--<i class="demo-pli-information icon-lg icon-fw"></i>帮助--}}
                            {{--</a>--}}
                            {{--<a href="{{route('layout')}}" class="list-group-item">--}}
                                {{--<i class="demo-pli-unlock icon-lg icon-fw"></i>退出--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                        <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                        <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                        <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul id="mainnav-menu" class="list-group">
                        @if(count($adminMenu) > 0)
                            @foreach($adminMenu as $m)
                                @if(isset($m['_child']))
                                    <li class="app-menu-parent {{getRequestRouteNames($m['_child']) == true ? 'active-sub active':''}}">
                                        <a href="javascript:;" class="app-menu-parent-a">
                                            <i class="{{$m['icon_class']}}"></i>
                                            <span class="menu-title">{{$m['title']}}</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse app-menu-parent-ul">
                                            @foreach($m['_child'] as $sub)
                                                <li class="{{request()->is(getNowRequestUrl($sub['route'])) ? 'active' : ''}}">
                                                    <a href="{{url($sub['route'])}}">{{$sub['title']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    {{--active-sub--}}
                                @elseif($m['parent_id'] == 0)
                                    <li class="{{active_class(if_route($m['route']),'active-sub')}}">
                                        <a href="{{url('home')}}">
                                            <i class="{{$m['icon_class']}}"></i>
                                            <span class="menu-title">{{$m['title']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>