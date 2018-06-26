<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('web-config.siteTitle')}}</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('static/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/highlight/styles/atom-one-dark.css')}}">
    <!-- CSS Files -->
    {!! Theme::css('css/bootstrap.min.css') !!}
    {!! Theme::css('css/now-ui-kit.css') !!}
    {!! Theme::css('css/demo.css') !!}
    @yield('my-css')
</head>
<body>
<div id="my-app">
    @include('common.header')
    @yield('banner')

    <div class="container" style="margin-top: 20px;margin-bottom: 20px;">
        <div class="row">
            @yield('content')
        </div>

    </div>

    @include('common.footer')
</div>
{!! Theme::js('js/core/jquery.3.2.1.min.js') !!}
{!! Theme::js('js/core/popper.min.js') !!}
{!! Theme::js('js/core/bootstrap.min.js') !!}
{!! Theme::js('js/core/bootstrap.min.js') !!}
{!! Theme::js('js/now-ui-kit.js') !!}
<script src="{{asset('static/highlight/highlight.pack.js')}}"></script>
<script>
    $(document).ready(function() {
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
</script>
@yield('my-js')
</body>
</html>