{{--父类--}}
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label" for="demo-hor-inputemail">父类</label>
        <div class="col-sm-6" id="app-select2">
            {!! Form::select('parent_id',$treeMenu,isset($menu)?$menu->parent_id:0,['class'=>'form-control app-select']) !!}
        </div>
    </div>
</div>
{{--标题--}}
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
{{--路由--}}
<div class="form-group {{ $errors->has('route') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">路由</label>
        <div class="col-sm-6">
            {!! Form::input('text','route',old('route'),['class'=>'form-control','placeholder'=>'请输入路由名称']) !!}
            @if ($errors->has('route'))
                <span class="help-block">
                    {{ $errors->first('route') }}
                </span>
            @endif
        </div>
    </div>
</div>

{{--打开方式--}}
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">打开方式</label>
        <div class="col-sm-9">
            <span class="app-radio-margin">
                {!! Form::radio('target','_self','checked',['class'=>'magic-radio','id'=>'menu_target_1']) !!}
                <label for="menu_target_1">本页打开</label>
            </span>
            <span class="app-radio-margin">
                {!! Form::radio('target','_blank','',['class'=>'magic-radio','id'=>'menu_target_2']) !!}
                <label for="menu_target_2">新窗体中打开</label>
            </span>
            <span class="app-radio-margin">
                {!! Form::radio('target','_parent','',['class'=>'magic-radio','id'=>'menu_target_3']) !!}
                <label for="menu_target_3">父窗体中打开</label>
            </span>
        </div>
    </div>
</div>
{{--图标--}}
<div class="form-group {{ $errors->has('icon_class') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">图标</label>
        <div class="col-sm-6">
            {!! Form::input('text','icon_class',old('icon_class'),['class'=>'form-control','placeholder'=>'请输入字体图标名称']) !!}
            @if ($errors->has('icon_class'))
                <span class="help-block">
                    {{ $errors->first('icon_class') }}
                </span>
            @endif
        </div>
    </div>
</div>

{{--颜色--}}
<div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">颜色</label>
        <div class="col-sm-2">
            {!! Form::input('text','color',old('color'),['class'=>'form-control','placeholder'=>'','id'=>'picker']) !!}
            @if ($errors->has('color'))
                <span class="help-block">
                    {{ $errors->first('color') }}
                </span>
            @endif
        </div>
        <div class="col-sm-2">
            @if(isset($menu))
                <span id="picker-show"
                      style="width: 35px;height: 35px;display: block; background: {{$menu->color}}"></span>
            @else
                <span id="picker-show"
                      style="width: 35px;height: 35px;display: block;"></span>
            @endif
        </div>
    </div>
</div>

{{--排序--}}
<div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">排序</label>
        <div class="col-sm-2">
            @if(isset($menu))
                {!! Form::input('text','order',null,['class'=>'form-control','placeholder'=>'']) !!}
            @else
                {!! Form::input('text','order',0,['class'=>'form-control','placeholder'=>'']) !!}
            @endif
            @if ($errors->has('order'))
                <span class="help-block">
                    {{ $errors->first('order') }}
                </span>
            @endif
        </div>
    </div>
</div>

{{--是否显示--}}
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">是否显示</label>
        <div class="col-sm-9">
            <span class="app-radio-margin">
                {!! Form::radio('is_show',1,'checked',['class'=>'magic-radio','id'=>'menu_is_show_1']) !!}
                <label for="menu_is_show_1">显示</label>
            </span>
            <span class="app-radio-margin">
                {!! Form::radio('is_show',0,'',['class'=>'magic-radio','id'=>'menu_is_show_2']) !!}
                <label for="menu_is_show_2">隐藏</label>
            </span>
        </div>
    </div>
</div>