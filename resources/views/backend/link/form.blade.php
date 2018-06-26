@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <style>
        #uploader-demo {
            position: relative;
        }

        #filePicker input[type=file] {
            opacity: 0;
        }
        .app-block-img-path{width: 150px;margin-right: 15px;}
    </style>
@endsection
<div id="app-form">

    <div class="form-group">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">分类</label>
            <div class="col-sm-3" id="app-select2">
                {!! Form::select('link_id',$linkCate,isset($link)?$link->link_id:'',['class'=>'form-control app-select']) !!}
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">名称</label>
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

    <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">链接</label>
            <div class="col-sm-3">
                {!! Form::input('text','url',old('url'),['class'=>'form-control','placeholder'=>'请输入链接地址']) !!}
                @if ($errors->has('url'))
                    <span class="help-block">
                    {{ $errors->first('url') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('user_name') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-3">
                {!! Form::input('text','user_name',old('user_name'),['class'=>'form-control','placeholder'=>'请输入用户名']) !!}
                @if ($errors->has('user_name'))
                    <span class="help-block">
                    {{ $errors->first('user_name') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('user_phone') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">手机号码</label>
            <div class="col-sm-3">
                {!! Form::input('text','user_phone',old('user_phone'),['class'=>'form-control','placeholder'=>'请输入手机号码']) !!}
                @if ($errors->has('user_phone'))
                    <span class="help-block">
                    {{ $errors->first('user_phone') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('user_email') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-3">
                {!! Form::input('text','user_email',old('user_email'),['class'=>'form-control','placeholder'=>'请输入邮箱']) !!}
                @if ($errors->has('user_email'))
                    <span class="help-block">
                    {{ $errors->first('user_email') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-4">
                {!! Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'请输入简短描述','rows'=>3]) !!}
                @if ($errors->has('description'))
                    <span class="help-block">
                    {{ $errors->first('description') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-1">
                {!! Form::input('text','order',0,['class'=>'form-control']) !!}
                @if ($errors->has('order'))
                    <span class="help-block">
                    {{ $errors->first('order') }}
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">logo</label>
            <div class="col-sm-10">
                {!! Form::input('text','logo',old('logo'),['class'=>'form-control pull-left app-block-img-path']) !!}
                <div id="uploader-demo" class="pull-left">
                    <div id="filePicker" class="btn btn-dark">选择图片</div>
                </div>
                @if ($errors->has('logo'))
                    <span class="help-block">
                    {{ $errors->first('logo') }}
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
        <label class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-4">
            <div class="radio">
                {!! Form::radio('is_show',1,'check',['class'=>'magic-radio','id'=>'demo-form-inline-input']) !!}
                <label for="demo-form-inline-input" class="mar-rgt pad-rgt">显示</label>
                &nbsp;&nbsp;
                {!! Form::radio('is_show',0,'',['class'=>'magic-radio','id'=>'demo-form-inline-textarea']) !!}
                <label for="demo-form-inline-textarea" class="mar-rgt pad-rgt">隐藏</label>
            </div>
        </div>
    </div>
</div>
@section('my-js')
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/webuploader/webuploader.min.js')}}"></script>
    <script type="text/javascript">

        $(function () {
            $('.app-select').select2(
                {
                    minimumResultsForSearch: -1
                }
            );
            $("#filePicker div:nth-child(2)").css({'width': '75px', 'height': '33px'});

        });
        var uploader = new WebUploader.Uploader({
            auto: true,
            swf: "{{asset('backend/plugins/webuploader/Uploader.swf')}}",
            server: "{{route('file.upload')}}",
            pick: '#filePicker',
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData: {
                _token: "{{csrf_token()}}",
                folder:'link'
            }
        });

        uploader.on('uploadStart', function (file) {
            console.log(file.size);
        });
        uploader.on('uploadSuccess', function (file, response) {
            if (response.success == true) {
                $(".app-block-img-path").val(response.data.path);
            }
        });

        uploader.on('uploadError', function (file) {
            swal({
                text: '文件上传失败！',
                title: '',
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        });
        uploader.on('error', function (type) {
            console.log(type);
        });
        uploader.on('uploadComplete', function (file) {
            uploader.removeFile(file);
        });
    </script>
@endsection

