@extends('layout.backend')
@section('content')
    <div class="tab-base  mar-no">
        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-1">基本信息</a>
            </li>
            <li>
                <a data-toggle="tab" href="#demo-lft-tab-2">SEO设置</a>
            </li>
            <li>
                <a data-toggle="tab" href="#demo-lft-tab-3">扩展选项</a>
            </li>
        </ul>
    </div>
    <div class="panel">

        <!--Data Table-->
        <!--===================================================-->
        {!! Form::model($post,['url'=>'backend/post/'.$post->id,'class'=>'form-horizontal']) !!}
        {{method_field('PUT')}}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="panel-body" style="padding-bottom: 10px;">
            <div class="tab-base">
                @include('backend.post.form')
            </div>

        </div>
        <div class="panel-footer" style="padding-bottom: 20px;">
            <div class="col-sm-offset-2">
                <button class="btn btn-success mar-rgt" type="submit"><i class="fa fa-save app-btn-i-margin-r-5"></i>保存</button>
                <button class="btn btn-mint mar-rgt" type="reset"><i class="fa fa-retweet app-btn-i-margin-r-5"></i>重置</button>
                <a class="btn btn-warning mar-rgt" href="javascript:history.go(-1)"><i class="fa fa-undo app-btn-i-margin-r-5"></i>返回上一页</a>
            </div>
        </div>
    {!! Form::close() !!}
    <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection