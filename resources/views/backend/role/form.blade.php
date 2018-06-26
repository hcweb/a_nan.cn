<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">名称</label>
        <div class="col-sm-6">
            {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入名称']) !!}
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
            {!! Form::input('text','alias',old('alias'),['class'=>'form-control','placeholder'=>'请输入别名']) !!}
            @if ($errors->has('alias'))
                <span class="help-block">
                    {{ $errors->first('alias') }}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('describe') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">描述</label>
        <div class="col-sm-8">
            {!! Form::textarea('describe',old('describe'),['class'=>'form-control','placeholder'=>'请输入描述','rows'=>'3']) !!}
            @if ($errors->has('describe'))
                <span class="help-block">
                    {{ $errors->first('describe') }}
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('permission') ? ' has-error' : '' }}">
    <div class="col-sm-12">
        <label class="col-sm-2 control-label">权限</label>
        <div class="col-sm-10">
            <div class="row">
                @if(count($allPermissions)>0)
                    @foreach($allPermissions as $v)
                        <div class="col-sm-2">
                            <div class="checkbox">
                                @if(isset($permissions))
                                <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                       type="checkbox"
                                       value="{{$v->name}}" name="permissions[]" {{in_array($v->name,$permissions) ? 'checked' : ''}}>
                                @else
                                    <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                           type="checkbox"
                                           value="{{$v->name}}" name="permissions[]">
                                    @endif
                                <label for="demo-form-checkbox-{{$v->id}}">{{$v->alias}}</label>
                            </div>
                        </div>
                    @endforeach
                 @endif
            </div>
            @if ($errors->has('permission'))
                <span class="help-block">
                    {{ $errors->first('permission') }}
                </span>
            @endif
        </div>
    </div>
</div>
