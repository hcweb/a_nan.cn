@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
{{--父类--}}
<div class="form-group {{ $errors->has('theme') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label" for="demo-hor-inputemail">主题</label>
        <div class="col-sm-3" id="app-select2">
            {!! Form::select('theme',$folders,old('theme'),['class'=>'form-control app-select']) !!}
            @if ($errors->has('theme'))
                <span class="help-block">
                    {{ $errors->first('theme') }}
                </span>
            @endif
        </div>
    </div>
</div>
{{--标题--}}
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">标题</label>
        <div class="col-sm-3">
            {!! Form::input('text','title',old('title'),['class'=>'form-control','placeholder'=>'请输入标题']) !!}
            @if ($errors->has('title'))
                <span class="help-block">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
    </div>
</div>
{{--路由--}}
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">模板用户</label>
        <div class="col-sm-3">
            {!! Form::input('text','username',old('route'),['class'=>'form-control','placeholder'=>'请输入模板用户名称']) !!}
        </div>
    </div>
</div>
@section('my-js')
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.app-select').select2({
                minimumResultsForSearch: -1
            });
        });
    </script>
@endsection