<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title',config('web-config.siteTitle'))</title>
    <meta name="keywords" content="{{config('web-config.siteKey')}}" />
    <meta name="description" content="{{config('web-config.sitedes')}}" />
    <meta name="author" content="xtn 871328529@qq.com" />
    <!-- CSS Files -->
    {!! Theme::css('css/bootstrap.min.css') !!}
    {!! Theme::css('css/app.css') !!}
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('static/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/highlight/styles/atom-one-dark.css')}}">
    <link rel="stylesheet" href="{{asset('static/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_686499_unz5bxnpfzi4fgvi.css">
    @yield('my-css')
</head>
<body>
<div id="my-app">
    @include('common.header')
    @yield('banner')
    <div class="app-container" style="margin-top: 2rem;margin-bottom: 1rem;">
        <div class="row ml-0 mr-0">
            @yield('content')
        </div>
    </div>
    @include('common.footer')
</div>
{!! Theme::js('js/jquery.min.js') !!}
{!! Theme::js('js/bootstrap.min.js') !!}
<script src="{{asset('static/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('static/sweetalert/sweetalert.min.js')}}"></script>
{!! Theme::js('js/common.js') !!}
<script>
    $(document).ready(function () {
        var pre=$('#post-content').find('pre');
        pre.each(function () {
            if ($(this).attr('class') != undefined){
                var type=$(this).attr('class').split(';')[0].split(':')[1];
                $(this).wrapInner(function () {
                    return '<code class="'+type+'"></code>';
                });

            }else {
                $(this).wrapInner(function () {
                    return '<code></code>';
                });
            }
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
    });
</script>
@yield('my-js')
</body>
</html>