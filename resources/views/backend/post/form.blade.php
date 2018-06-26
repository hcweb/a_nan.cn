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
        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label" for="demo-hor-inputemail">所属类别</label>
                <div class="col-sm-3" id="app-select2">
                    <select class="form-control app-select" name="category_id">
                        @if($treeMenu)
                            @foreach($treeMenu as $v)
                                @if(isset($post) && $post->category_id == $v->id)
                                    <option value="{{$v->id}}"
                                            selected>{{str_repeat('-',$v->depth*2)}}{{$v->title}}</option>
                                @else
                                    <option value="{{$v->id}}">{{str_repeat('-',$v->depth*2)}}{{$v->title}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                    {{ $errors->first('category_id') }}
                </span>
                    @endif
                </div>
            </div>
        </div>

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
                    {!! Form::input('text','alias',old('alias'),['class'=>'form-control category-alias','placeholder'=>'输入标题后将自动翻译为英文']) !!}
                    @if ($errors->has('alias'))
                        <span class="help-block">
                    {{ $errors->first('alias') }}
                </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">Tags标签</label>
                <div class="col-sm-3">
                    {!! Form::select('tags[]',$tags,null,['class'=>'form-control app-select tag-select','multiple'=>"multiple"]) !!}
                    @if ($errors->has('tags'))
                        <span class="help-block">
                    {{ $errors->first('tags') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('thumb') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">封面图片</label>
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
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">推荐类型</label>
                <div class="col-sm-9">
                    <span class="app-radio-margin">
                {!! Form::checkbox('is_comment',0,isset($post)&& $post->is_comment == 1?'checked':'',['class'=>'magic-checkbox ty-type','id'=>'menu_target_0']) !!}
                        <label for="menu_target_0">允许评论</label>
            </span>
                    <span class="app-radio-margin">
                {!! Form::checkbox('is_top',0,isset($post)&& $post->is_top == 1?'checked':'',['class'=>'magic-checkbox ty-type','id'=>'menu_target_1']) !!}
                        <label for="menu_target_1">置顶</label>
            </span>
                    <span class="app-radio-margin">
                {!! Form::checkbox('is_tuijian',0,isset($post)&& $post->is_tuijian == 1?'checked':'',['class'=>'magic-checkbox ty-type','id'=>'menu_target_2']) !!}
                        <label for="menu_target_2">推荐</label>
            </span>
                    <span class="app-radio-margin">
                {!! Form::checkbox('is_hot',0,isset($post)&& $post->is_hot == 1?'checked':'',['class'=>'magic-checkbox ty-type','id'=>'menu_target_3']) !!}
                        <label for="menu_target_3">热门</label>
            </span>
                    <span class="app-radio-margin">
                {!! Form::checkbox('is_slide',0,isset($post)&& $post->is_slide == 1?'checked':'',['class'=>'magic-checkbox ty-type','id'=>'menu_target_4']) !!}
                        <label for="menu_target_4">幻灯片</label>
            </span>
                </div>
            </div>
        </div>


        {{--排序--}}
        <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">排序</label>
                <div class="col-sm-1">
                    @if(isset($post))
                        {!! Form::input('text','order',$post->order,['class'=>'form-control','placeholder'=>'']) !!}
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

        <div class="form-group {{ $errors->has('views') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">浏览次数</label>
                <div class="col-sm-1">
                    @if(isset($post))
                        {!! Form::input('text','views',$post->views,['class'=>'form-control','placeholder'=>'']) !!}
                    @else
                        {!! Form::input('text','views',0,['class'=>'form-control','placeholder'=>'']) !!}
                    @endif
                    @if ($errors->has('views'))
                        <span class="help-block">
                    {{ $errors->first('views') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('push_time') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">发布时间</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                        {!! Form::input('text','push_time',old('push_time'),['class'=>'form-control','placeholder'=>'不选择为当前时间','onclick'=>"WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"]) !!}
                    </div>

                    @if ($errors->has('push_time'))
                        <span class="help-block">
                    {{ $errors->first('push_time') }}
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
        <div class="form-group {{ $errors->has('source') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">信息来源</label>
                <div class="col-sm-3">
                    {!! Form::input('text','source','本站',['class'=>'form-control']) !!}
                    @if ($errors->has('source'))
                        <span class="help-block">
                    {{ $errors->first('source') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('author') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">文章作者</label>
                <div class="col-sm-3">
                    {!! Form::input('text','author','管理员',['class'=>'form-control']) !!}
                    @if ($errors->has('author'))
                        <span class="help-block">
                    {{ $errors->first('author') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('summary') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">内容摘要</label>
                <div class="col-sm-3">
                    {!! Form::textarea('summary',old('summary'),['class'=>'form-control','rows'=>3]) !!}
                    @if ($errors->has('summary'))
                        <span class="help-block">
                    {{ $errors->first('summary') }}
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-1 col-xs-2 col-md-1 control-label">内容描述</label>
                <div class="col-sm-10">
                    <script id="app-block-body" name="description" type="text/plain">
                        @if(isset($post))
                            {!! $post->description !!}
                        @endif
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div id="demo-lft-tab-3" class="tab-pane fade">
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
                <div class="col-sm-3">
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
                <div class="col-sm-3">
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
</div>
@section('my-js')
    <script src="{{asset('backend/plugins/webuploader/webuploader.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
    <script src="{{ asset('backend/plugins/jquery.color.picker/js/colpick.js') }}"></script>
    <script src="{{ asset('static/My97DatePicker/WdatePicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".ty-type").each(function () {
                if ($(this).prop("checked")) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
            $(".ty-type").change(function () {
                if ($(this).prop('checked') == true) {
                    $(this).val(1);
                } else {
                    $(this).prop('checked', false);
                    $(this).val(0);
                }
            });

            $("#filePicker div:nth-child(2)").css({'width': '75px', 'height': '33px'});
                    @if(Route::currentRouteName() === 'post.edit')
            var activeTag = "{{$activeTags}}";
            $('.tag-select').val(activeTag.split(',')).trigger("change");
            @endif
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

        }
        ;

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
