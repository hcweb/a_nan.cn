@extends('layout.backend')
@section('content')
    <div class="panel app-display-flex">
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body app-display-flex" style="padding-bottom: 10px;">
                <img src="{{asset($user->avatar)}}" alt="" class="img-circle mar-btm" style="width: 70px;height:70px;">
                <ul class="list-unstyled" style="width: 170px">
                    <li class="col-sm-12">用户名:<label>{{$user->name}}</label></li>
                    <li class="col-sm-12">邮箱:<label>{{$user->email}}</label></li>
                    <li class="col-sm-12">手机:<label>{{$user->tel}}</label></li>
                    <li class="col-sm-12">状态:<label>{{$user->tel}}</label></li>
                </ul>
        </div>
        <div class="panel-footer" style="padding-bottom: 20px;">
            <a class="btn btn-warning mar-rgt" href="javascript:history.go(-1)"><i
                        class="fa fa-undo app-btn-i-margin-r-5"></i>返回上一页</a>
        </div>
        <!--===================================================-->

    </div>
@endsection