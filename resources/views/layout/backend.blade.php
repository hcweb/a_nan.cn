<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title',config('web-config.siteTitle','馋猫优鲜'))</title>
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/nifty.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/demo/nifty-demo.min.css')}}" rel="stylesheet">
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('backend/plugins/themify-icons/themify-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/common.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/themes/type-d/theme-lime.min.css')}}" rel="stylesheet">
    <script>
        window.hcweb = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('my-css')
</head>

<body>
{{--@php--}}
    {{--var_dump(cache('admin.menu'));--}}
    {{--die();--}}
{{--@endphp--}}
<div id="hcweb-app">
    <div id="container" class="effect aside-float aside-bright mainnav-lg mainnav-fixed  navbar-fixed">
        @include('backend.common._header')
        <div class="boxed">
            <div id="content-container">
                @if(request()->route()->getName() != 'home')
                    @include('backend.common.breadcrumb')
                @endif
                <div id="page-content">
                    @yield('content')
                </div>
            </div>
            @include('backend.common._left')
        </div>
        @include('backend.common._footer')
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>

    </div>
</div>
<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/nifty.min.js')}}"></script>
<script src="{{asset('backend/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('backend/js/backend.js')}}"></script>
@yield('my-js')
@include('sweet::alert')
</body>
</html>
