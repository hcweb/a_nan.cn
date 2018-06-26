@section('my-css')
    <style>
        /*.app_system_value{display: none;}*/
        /*.app_system_active{display: block;}*/
    </style>
@endsection
<div id="app-form">
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        <div class="col-sm-8">
            <label class="col-sm-3 control-label">标题</label>
            <div class="col-sm-6">
                {!! Form::input('text','title',old('title'),['class'=>'form-control','placeholder'=>'请输入标题']) !!}
                @if ($errors->has('title'))
                    <span class="help-block">
                    {{ $errors->first('title') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <div class="col-sm-8">
            <label class="col-sm-3 control-label">名称</label>
            <div class="col-sm-6">
                {!! Form::input('text','name',old('title'),['class'=>'form-control','placeholder'=>'请输入名称']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <label class="col-sm-3 control-label">类型</label>
            <div class="col-sm-9">
                <div class="radio">
                    {!! Form::radio('type','input','check',['class'=>'magic-radio','id'=>'demo-form-inline-input','v-model'=>'type']) !!}
                    <label for="demo-form-inline-input" class="mar-rgt pad-rgt">input</label>
                    &nbsp;&nbsp;
                    {!! Form::radio('type','textarea','',['class'=>'magic-radio','id'=>'demo-form-inline-textarea','v-model'=>'type']) !!}
                    <label for="demo-form-inline-textarea" class="mar-rgt pad-rgt">textarea</label>
                    &nbsp;&nbsp;
                    {!! Form::radio('type','radio','',['class'=>'magic-radio','id'=>'demo-form-inline-radio','v-model'=>'type']) !!}
                    <label for="demo-form-inline-radio" class="mar-rgt pad-rgt">radio</label>
                    &nbsp;&nbsp;
                    {!! Form::radio('type','image','',['class'=>'magic-radio','id'=>'demo-form-inline-image','v-model'=>'type']) !!}
                    <label for="demo-form-inline-image" class="mar-rgt pad-rgt">image</label>

                </div>
            </div>
        </div>
    </div>
    <div class="form-group" v-if="type == 'radio'">
        <div class="col-sm-8 app_system_value">
            <label class="col-sm-3 control-label">类型值</label>
            <div class="col-sm-9">
                <div class="radio">
                    {!! Form::radio('value',1,'check',['class'=>'magic-radio','id'=>'demo-form-inline-open','v-model'=>'mValue']) !!}
                    <label for="demo-form-inline-open" class="mar-rgt pad-rgt">开启</label>
                    &nbsp;&nbsp;
                    {!! Form::radio('value',0,'',['class'=>'magic-radio','id'=>'demo-form-inline-off','v-model'=>'mValue']) !!}
                    <label for="demo-form-inline-off" class="mar-rgt pad-rgt">关闭</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
        <div class="col-sm-8">
            <label class="col-sm-3 control-label">排序</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-3">
                        @if(isset($system))
                            {!! Form::input('text','order',old('order'),['class'=>'form-control','placeholder'=>'']) !!}
                        @else
                            {!! Form::input('text','order',0,['class'=>'form-control','placeholder'=>'']) !!}
                        @endif
                    </div>
                </div>
                @if ($errors->has('order'))
                    <span class="help-block">
                    {{ $errors->first('order') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
        <div class="col-sm-8">
            <label class="col-sm-3 control-label">内容</label>
            <div class="col-sm-7">
                {!! Form::textarea('content',old('content'),['class'=>'form-control','placeholder'=>'请输入内容','rows'=>'3']) !!}
                @if ($errors->has('content'))
                    <span class="help-block">
                    {{ $errors->first('content') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <label class="col-sm-3 control-label">备注</label>
            <div class="col-sm-7">
                {!! Form::textarea('tips',old('tips'),['class'=>'form-control','placeholder'=>'请输入内容','rows'=>'3']) !!}
                <span class="help-block">

            </span>
            </div>
        </div>
    </div>
    @section('my-js')
        <script src="{{asset('backend/plugins/vue/vue.js')}}"></script>
        <script type="text/javascript">
            var vm = new Vue({
                el: '#app-form',
                data: {
                    type: 'input',
                    mValue: 1
                },
                created: function () {
                    @if(isset($system))
                        this.type = "{{$system->type}}";
                        this.mValue = "{{$system->value}}";
                    @else
                        this.type = 'input';
                        this.mValue = 1;
                    @endif
                }
            });
        </script>
    @endsection

</div>