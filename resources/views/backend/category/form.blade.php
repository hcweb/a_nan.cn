@include('vendor.ueditor.assets')
@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/jquery.color.picker/css/colpick.css') }}">
    <style>
        #uploader-demo {
            position: relative;
        }

        #filePicker input[type=file] {
            opacity: 0;
        }

        .app-block-img-path {
            width: 150px;
            margin-right: 15px;
        }
    </style>
@endsection
<div class="tab-content bg-gray">
    <div id="demo-lft-tab-1" class="tab-pane fade active in">
        {{--父类--}}
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label" for="demo-hor-inputemail">父类</label>
                <div class="col-sm-3" id="app-select2">
                    <select class="form-control app-select" name="parent_id">
                        <option value="0" selected="selected">顶级栏目</option>
                        @if($treeMenu)
                            @foreach($treeMenu as $v)
                                @if(isset($category) && $category->id == $v->id)
                                    <option value="{{$v->id}}" selected>{{str_repeat('-',$v->depth*2)}}{{$v->title}}</option>
                                    @else
                                    <option value="{{$v->id}}">{{str_repeat('-',$v->depth*2)}}{{$v->title}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        {{--标题--}}
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">标题</label>
                <div class="col-sm-3">
                    {!! Form::input('text','title',old('title'),['class'=>'form-control category-title','placeholder'=>'请输入标题']) !!}
                    @if ($errors->has('title'))
                        <span class="help-block">
                    {{ $errors->first('title') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">调用别名</label>
                <div class="col-sm-3">
                    {!! Form::input('text','alias',old('alias'),['class'=>'form-control category-alias','readonly'=>'readonly']) !!}
                    @if ($errors->has('alias'))
                        <span class="help-block">
                    {{ $errors->first('alias') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        {{--路由--}}
        <div class="form-group {{ $errors->has('route') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">路由</label>
                <div class="col-sm-3">
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
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">打开方式</label>
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
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">图标</label>
                <div class="col-sm-3">
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
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">颜色</label>
                <div class="col-sm-1">
                    {!! Form::input('text','color',old('color'),['class'=>'form-control','placeholder'=>'','id'=>'picker']) !!}
                    @if ($errors->has('color'))
                        <span class="help-block">
                    {{ $errors->first('color') }}
                </span>
                    @endif
                </div>
                <div class="col-sm-2">
                    @if(isset($category))
                        <span id="picker-show"
                              style="width: 35px;height: 35px;display: block; background: {{$category->color}}"></span>
                    @else
                        <span id="picker-show"
                              style="width: 35px;height: 35px;display: block;"></span>
                    @endif
                </div>
            </div>
        </div>

        {{--排序--}}
        <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">排序</label>
                <div class="col-sm-1">
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
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">是否显示</label>
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
    </div>
    <div id="demo-lft-tab-2" class="tab-pane fade">
        <div class="form-group {{ $errors->has('seo_title') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">SEO标题</label>
                <div class="col-sm-3">
                    {!! Form::input('text','seo_title',old('seo_title'),['class'=>'form-control']) !!}
                    @if ($errors->has('seo_title'))
                        <span class="help-block">
                    {{ $errors->first('seo_title') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('seo_key') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">SEO关健字</label>
                <div class="col-sm-5">
                    {!! Form::textarea('seo_key',old('seo_key'),['class'=>'form-control','rows'=>'3']) !!}
                    @if ($errors->has('seo_key'))
                        <span class="help-block">
                    {{ $errors->first('seo_key') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('seo_content') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">SEO描述</label>
                <div class="col-sm-5">
                    {!! Form::textarea('seo_content',old('seo_content'),['class'=>'form-control','rows'=>'3']) !!}
                    @if ($errors->has('seo_content'))
                        <span class="help-block">
                    {{ $errors->first('seo_content') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="demo-lft-tab-3" class="tab-pane fade">
        <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">URL链接</label>
                <div class="col-sm-3">
                    {!! Form::input('text','url',old('url'),['class'=>'form-control']) !!}
                    @if ($errors->has('url'))
                        <span class="help-block">
                    {{ $errors->first('url') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('thumb') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">显示图片</label>
                <div class="col-sm-10">
                    {!! Form::input('text','thumb',old('thumb'),['class'=>'form-control pull-left app-block-img-path']) !!}
                    <div id="uploader-demo" class="pull-left">
                        <div id="filePicker" class="btn btn-dark">选择图片</div>
                    </div>
                    @if ($errors->has('thumb'))
                        <span class="help-block">
                    {{ $errors->first('thumb') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">类别介绍</label>
                <div class="col-sm-10">
                    <script id="app-block-body" name="description" type="text/plain">
                        @if(isset($category))
                            {!! $category->description !!}
                        @endif
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@section('my-js')
    <script src="{{asset('backend/plugins/webuploader/webuploader.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
    <script src="{{ asset('backend/plugins/jquery.color.picker/js/colpick.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#filePicker div:nth-child(2)").css({'width': '75px', 'height': '33px'});
            $('.app-select').select2();
            $('#picker').colpick({
                layout: 'hex',
                submit: 0,
                colorScheme: 'dark',
                onChange: function (hsb, hex, rgb, el, bySetColor) {
                    $("#picker-show").css('background', '#' + hex);
                    if (!bySetColor) $(el).val('#' + hex);
                }
            }).keyup(function () {
                $(this).colpickSetColor(this.value);
            });

            $(".category-title").blur(function () {
                if ($(this).val() != '') {
                    translate($(this).val());
                }
            });
        });

        var ue = UE.getEditor('app-block-body', {
            autoHeightEnabled: false,
            initialFrameHeight: 350
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });

        function translate($query) {
            $.get('/translate/' + $query, function (response) {
                if (response.success == true) {
                    $(".category-alias").val(response.data);
                }
            });

        };

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
                _token: "{{csrf_token()}}"
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
