@extends('layout.backend')
@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/jquery.color.picker/css/colpick.css') }}">
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">编辑菜单</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        {!! Form::model($menu,['url'=>'backend/menu/'.$menu->id,'class'=>'form-horizontal']) !!}
        {{method_field('PUT')}}
        <div class="panel-body" style="padding-bottom: 10px;">
            @include('backend.menu.form')
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

@section('my-js')
    {{--<script src="{{asset('backend/js/demo/nifty-demo.min.js')}}"></script>--}}
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/jquery.color.picker/js/colpick.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.app-select').select2();
            $('#picker').colpick({
                layout:'hex',
                submit:0,
                colorScheme:'dark',
                onChange:function(hsb,hex,rgb,el,bySetColor) {
                    $("#picker-show").css('background','#'+hex);
                    if(!bySetColor) $(el).val('#'+hex);
                }
            }).keyup(function(){
                $(this).colpickSetColor(this.value);
            });
        });
    </script>
@endsection