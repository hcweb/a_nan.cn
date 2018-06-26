<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404-{{config('web-config.siteTitle','恒创网络')}}</title>
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #box{position: fixed;left: 0;top:0;display: flex;display: -webkit-flex;justify-content: center;align-items: center;width: 100%;height: 100%;flex-direction: column;}
        #box img{width: 40%;}
        #box h4{margin-top: 20px;margin-bottom: 20px;}
    </style>
</head>
<body>
<div id="box">
    <img src="{{asset('static/img/404.png')}}">
    <h4>矮油~~您访问的页面不在地球上...</h4>
    <a href="javascript:;" onclick="javascript:history.go(-1)" class="btn btn-danger">返回上一页</a>
</div>
</body>
</html>