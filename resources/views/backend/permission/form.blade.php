@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">分类</label>
        <div class="col-sm-6" id="app-select2">
            {!! Form::select('menu_id',$menus,isset($permission)?$permission->menu_id:'',['class'=>'form-control app-select']) !!}
            <span class="help-block">
            </span>
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">名称</label>
        <div class="col-sm-6">
            {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入名称','v-model'=>'name']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">别名</label>
        <div class="col-sm-6">
            {!! Form::input('text','alias',old('alias'),['class'=>'form-control','placeholder'=>'请输入别名','v-model'=>'alias']) !!}
            @if ($errors->has('alias'))
                <span class="help-block">
                    {{ $errors->first('alias') }}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">描述</label>
        <div class="col-sm-7">
            {!! Form::textarea('describe',old('describe'),['class'=>'form-control','placeholder'=>'请输入别名','rows'=>'3','v-model'=>'describe']) !!}
            <span class="help-block">

            </span>
        </div>
    </div>
</div>
@section('my-js')
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.app-select').select2();
        });
    </script>
@endsection
