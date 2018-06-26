@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">添加配置</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        {!! Form::open(['route'=>'system.store','class'=>'form-horizontal']) !!}
        <div class="panel-body" style="padding-bottom: 10px;">
            @include('backend.system.form')
        </div>
        <div class="panel-footer" style="padding-bottom: 20px;">
            <div class="col-sm-offset-2">
                <button class="btn btn-success mar-rgt" type="submit"><i class="fa fa-plus app-btn-i-margin-r-5"></i>添加</button>
                <button class="btn btn-mint mar-rgt" type="reset"><i class="fa fa-retweet app-btn-i-margin-r-5"></i>重置</button>
                <a class="btn btn-warning mar-rgt" href="javascript:history.go(-1)"><i class="fa fa-undo app-btn-i-margin-r-5"></i>返回上一页</a>
            </div>
        </div>
    {!! Form::close() !!}
    <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection