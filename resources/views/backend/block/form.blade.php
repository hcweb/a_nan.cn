@include('vendor.ueditor.assets')
@section('my-css')
    <style>
        #uploader-demo {
            position: relative;
        }

        #filePicker input[type=file] {
            opacity: 0;
        }

        .app-block-img-box {
            position: relative;
            width: 120px;
            display: none;
        }

        .app-block-img-box img {
            width: 100%;
        }
        .active{display: block;}
        .app-block-img-box i {
            position: absolute;
            width: 20px;
            height: 20px;
            display: block;
            background: red;
            color: #ffffff;
            border-radius: 100px;
            right: -10px;
            top: -10px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
        }
    </style>
@endsection
<div id="app-form">
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">资料名称</label>
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

    <div class="form-group">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">资料类型</label>
            <div class="col-sm-4">
                <div class="radio">
                    {!! Form::radio('type','F','check',['class'=>'magic-radio','id'=>'demo-form-inline-input','v-model'=>'type','v-on:change'=>'getType("F")']) !!}
                    <label for="demo-form-inline-input" class="mar-rgt pad-rgt">文字</label>
                    &nbsp;&nbsp;
                    {!! Form::radio('type','I','',['class'=>'magic-radio','id'=>'demo-form-inline-textarea','v-model'=>'type','v-on:change'=>'getType("I")']) !!}
                    <label for="demo-form-inline-textarea" class="mar-rgt pad-rgt">图片</label>
                    &nbsp;&nbsp;
                    {!! Form::radio('type','E','',['class'=>'magic-radio','id'=>'demo-form-inline-radio','v-model'=>'type','v-on:change'=>'getType("E")']) !!}
                    <label for="demo-form-inline-radio" class="mar-rgt pad-rgt">编辑</label>

                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('body.E')|| $errors->has('body.I') || $errors->has('body.F')? ' has-error' : '' }}">
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">资料内容</label>
            <div class="col-sm-9">
                <div class="row">
                    <div v-show="type == 'F'" class="col-sm-6">
                        {!! Form::textarea('body[F]',old('body[F]'),['class'=>'form-control','placeholder'=>'请输入内容','rows'=>'5']) !!}
                    </div>
                </div>
                <div v-show="type == 'I'">
                    <div style="width: 200px;" class="pull-left">
                        {!! Form::text('body[I]',old('body[I]'),['class'=>'form-control app-block-img-path']) !!}
                    </div>
                    <div id="uploader-demo" class="pull-left mar-lft">
                        <div id="filePicker" class="btn btn-dark">选择图片</div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="mar-top app-block-img-box {{(isset($block) && $block->type=='I' && !empty($block->body[$block->type])) ? 'active' : ''}}">
                        @if(isset($block) && !empty($block->body[$block->type]))
                        <i class="fa fa-minus-circle app-remove-logo"
                           data-path="{{$block->body[$block->type]}}" data-id="{{$block->id}}" title="点击删除,重新上传"></i>
                        <img src="{{asset($block->body[$block->type])}}" alt=""
                             class="pull-left">
                            @else
                            <i class="fa fa-minus-circle app-remove-logo"
                               data-path="" title="点击删除,重新上传"></i>
                            <img src="" alt=""
                                 class="pull-left">
                        @endif
                    </div>
                </div>
                <div v-show="type == 'E'">
                    <script id="app-block-body" name="body[E]" value="body[E]" type="text/plain">
                        @if(isset($block) && $block->type=='E')
                            {!! $block->body['E'] !!}
                            @endif
                    </script>
                </div>

                @if ($errors->has('body.E')|| $errors->has('body.I') || $errors->has('body.F'))
                    <span class="help-block">
                    {{ $errors->first('body.E') }}
                        {{ $errors->first('body.I') }}
                        {{ $errors->first('body.F') }}
                </span>
                @endif

            </div>
        </div>
    </div>
</div>

@section('my-js')
    <script src="{{asset('backend/plugins/webuploader/webuploader.min.js')}}"></script>
    <script src="{{asset('backend/plugins/vue/vue.js')}}"></script>
    <script type="text/javascript">

        var vm = new Vue({
            el: '#app-form',
            data: {
                type: 'F'
            },
            created: function () {
                @if(isset($block))
                    this.type="{{$block->type}}";
                @else
                    this.type = 'F';
                @endif
            },
            methods: {
                getType: function (type) {

                }
            }
        });
        var ue = UE.getEditor('app-block-body', {
            autoHeightEnabled: false,
            initialFrameHeight: 350
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
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
                _token: "{{csrf_token()}}"
            }
        });

        uploader.on('uploadStart', function (file) {
            console.log(file.size);
        });
        uploader.on('uploadSuccess', function (file, response) {
            if (response.success == true) {
                $(".app-block-img-box").show();
                $(".app-block-img-box img").attr('src', response.data.fullPath);
                $(".app-block-img-path").val(response.data.path);
                $(".app-remove-logo").attr('data-path', response.data.path);
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

        $(function () {
            $("#filePicker div:nth-child(2)").css({'width': '75px', 'height': '33px'});
            $(".app-remove-logo").click(function () {
                $.post("{{route('file.remove')}}", {
                    _token: "{{csrf_token()}}",
                    path: $(this).attr('data-path')
                }, function (response) {
                    if (response.success == true) {
                        $(".app-block-img-box").hide();
                        $(".app-block-img-path").val('');
                        $(this).attr('data-path', '');

                        @if(isset($block))
                            $.post("{{route('block.updateBody')}}",{
                                 id:$(".app-remove-logo").attr('data-id'),
                                 body:'',
                                _token:"{{csrf_token()}}"
                        },function (response) {
                            console.log(response);
                        });
                        @endif
                    }
                });

            });
        })
    </script>
@endsection

