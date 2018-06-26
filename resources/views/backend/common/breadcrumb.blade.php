{{--@php--}}
    {{--$breadcrumbs=displayBreadcrumbs();--}}
{{--@endphp--}}
{{--@if(count($breadcrumbs) > 0)--}}
    {{--<div id="page-head">--}}
        {{--<div id="page-title">--}}
            {{--<h1 class="page-header text-overflow">{{end($breadcrumbs)['title']}}</h1>--}}
        {{--</div>--}}
        {{--<ol class="breadcrumb">--}}
            {{--<li><a href="{{url('home')}}"><i class="demo-pli-home"></i></a></li>--}}
            {{--@foreach( $breadcrumbs as $v)--}}
                {{--@if($v['route'] == 'javascript:;')--}}
                    {{--<li><a href="javascript:;">{{$v['title']}}</a></li>--}}
                {{--@else--}}
                    {{--<li><a href="{{url($v['route'])}}">{{$v['title']}}</a></li>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</ol>--}}
    {{--</div>--}}
{{--@endif--}}