<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('web-config.siteTitle','app.name')}}-用户登录</title>
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/nifty.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('backend/plugins/pace/pace.min.js')}}"></script>
    <link href="{{asset('backend/css/demo/nifty-demo.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/themes/type-e/theme-lime.min.css')}}" rel="stylesheet">
</head>
<body>
<div id="container" class="cls-container bg-primary">
    <div id="bg-overlay"></div>
    <div class="cls-content">
        <div class="cls-content-sm panel" style="background: #fff !important;">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    {{--<h1 class="h3">{{config('web-config.siteTitle','app.name')}}</h1>--}}
                    <img src="{{asset(config('web-config.siteLogoo'))}}" alt="" style="width: 130px;">
                </div>
                <form action="{{route('loginForm')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="请输入邮箱" value="{{old('email')}}" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="请输入密码">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8 col-xs-8">
                                <input type="text" name="captcha" class="form-control" placeholder="请输入验证码">
                            </div>
                            <div class="col-sm-4 col-xs-4">
                                <img src="{{ captcha_src('default') }}" alt="" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码" style="width: 100%;height: 33px;">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input id="demo-form-checkbox" name="rember_me" class="magic-checkbox" type="checkbox">
                        <label for="demo-form-checkbox">记住密码</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">立即登录</button>
                </form>
            </div>

            <div class="pad-all">
                <a href="pages-password-reminder.html" class="btn-link mar-rgt">忘记密码 ?</a>
                <a href="pages-register.html" class="btn-link mar-lft">联系管理员</a>
                {{--<div class="media pad-top bord-top">--}}
                    {{--<div class="pull-right">--}}
                        {{--<a href="#" class="pad-rgt"><i class="demo-psi-facebook icon-lg text-primary"></i></a>--}}
                        {{--<a href="#" class="pad-rgt"><i class="demo-psi-twitter icon-lg text-info"></i></a>--}}
                        {{--<a href="#" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>--}}
                    {{--</div>--}}
                    {{--<div class="media-body text-left text-bold text-main">--}}
                        {{--Login with--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    <div class="demo-bg">
        <div id="demo-bg-list">
            <div class="demo-loading"><i class="psi-repeat-2"></i></div>
            <img class="demo-chg-bg bg-trans active" src="{{asset('backend/img/bg-img/thumbs/bg-trns.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-1.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-2.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-3.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-4.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-5.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-6.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('backend/img/bg-img/thumbs/bg-img-7.jpg')}}" alt="Background Image">
        </div>
    </div>
</div>
<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/nifty.min.js')}}"></script>
<script src="{{asset('backend/js/demo/bg-images.js')}}"></script>
<script src="{{asset('backend/plugins/sweetalert/sweetalert.min.js')}}"></script>
@if ($errors->any())
    <script type="text/javascript">
        swal({
            text:"@foreach ($errors->all() as $error){{ $error }}@endforeach",
            title:'',
            type:'error',
            timer:3000,
            showConfirmButton:false
        });
    </script>
@endif
</body>
</html>
