@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">编辑角色</h3>
        </div>
        {!! Form::model($role,['url'=>'backend/role/'.$role->id,'class'=>'form-horizontal']) !!}
        <input type="hidden" value="{{$role->id}}" name="role_id">
        {{method_field('PUT')}}
        <div class="panel-body" style="padding-bottom: 10px;">
            @include('backend.role.form')
        </div>
        <div class="panel-footer" style="padding-bottom: 20px;">
            <div class="col-sm-offset-2">
                <button class="btn btn-success mar-rgt" type="submit"><i class="fa fa-save app-btn-i-margin-r-5"></i>保存
                </button>
                <button class="btn btn-mint mar-rgt" type="reset"><i class="fa fa-retweet app-btn-i-margin-r-5"></i>重置
                </button>
                <a class="btn btn-warning mar-rgt" href="javascript:history.go(-1)"><i
                            class="fa fa-undo app-btn-i-margin-r-5"></i>返回上一页</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection