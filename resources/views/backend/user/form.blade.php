@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/plugins/uploader/css/jquery.dm-uploader.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/Jcrop/Jcrop.min.css')}}">
    <style>
        #user_avatar {
            display: none;
        }

        .app-file-btn {
            position: relative;
            overflow: hidden;
        }

        .app-file-btn input {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            opacity: 0;
        }

        .pekecontainer {
            display: none;
        }

        #avatar-tmp {
            width: 100%;
        }

        #app-crop-img {
            padding-right: 135px;
            position: relative;
        }

        #avatar-crop .jcrop-active {
            position: static;
        }

        #avatar-crop .jcrop-thumb {
            right: 0;
            top: 0;
        }

        #app-crop-img span {
            display: block;
            width: 120px;
            height: 120px;
            padding: 10px;
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
@endsection
<div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">角色</label>
        <div class="col-sm-6" id="app-select2">
            {!! Form::select('role',$roles,$roles['choseRole'],['class'=>'form-control app-select']) !!}
            @if ($errors->has('role'))
                <span class="help-block">
                    {{ $errors->first('role') }}
                </span>
            @endif
        </div>
    </div>
</div>
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

<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">邮箱</label>
        <div class="col-sm-6">
            {!! Form::input('text','email',old('email'),['class'=>'form-control','placeholder'=>'请输入邮箱']) !!}
            @if ($errors->has('email'))
                <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('tel') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">手机</label>
        <div class="col-sm-6">
            {!! Form::input('text','tel',old('tel'),['class'=>'form-control','placeholder'=>'请输入手机']) !!}
            @if ($errors->has('tel'))
                <span class="help-block">
                    {{ $errors->first('tel') }}
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">密码</label>
        <div class="col-sm-6">
            {!! Form::input('password','password',isset($user)?'0|0|0|0':'',['class'=>'form-control','placeholder'=>'请输入密码']) !!}
            @if ($errors->has('password'))
                <span class="help-block">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">确认密码</label>
        <div class="col-sm-6">
            {!! Form::input('password','password_confirmation',isset($user)?'0|0|0|0':'',['class'=>'form-control','placeholder'=>'请输入确认密码']) !!}
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">图像</label>
        <div class="col-sm-4">
            {!! Form::input('text','avatar',old('avatar'),['class'=>'form-control','id'=>'user_avatar_url']) !!}
            @if(isset($user) && $user->avatar)
                <style>
                    #user_avatar {
                        display: block;
                    }
                    #user_avatar img{width: 50px;height: 50px;}
                </style>
                <span class="help-block" id="user_avatar">
                    <img style="width: 50px;height: 50px;" src="{{asset($user->avatar)}}" class="img-circle">
                </span>
            @else
                <span class="help-block" id="user_avatar">
                    <img style="width: 50px;height: 50px;" src="" class="img-circle">
                </span>
            @endif
        </div>
        <div class="col-sm-2">
            <div class="btn btn-dark app-file-btn">
                {!! Form::file('imgUrl',['title'=>'点击上传图片','id'=>'file_upload','accept'=>'image/gif, image/jpeg,image/png, image/jpg']) !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-8">
        <label class="col-sm-3 control-label">是否可用</label>
        <div class="col-sm-6">
            <div class="checkbox" style="width: auto;">
                {!! Form::radio('is_enabled',1,true,['class'=>'magic-radio','id'=>'is_enabled_true']) !!}
                <label for="is_enabled_true">可用</label>
            </div>
            <div class="checkbox" style="width: auto;">
                {!! Form::radio('is_enabled',0,false,['class'=>'magic-radio','id'=>'is_enabled_false']) !!}
                <label for="is_enabled_false">禁用</label>
            </div>
        </div>
    </div>
</div>



