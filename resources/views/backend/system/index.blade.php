@extends('layout.backend')
@section('my-css')
    <style>
        #filePicker input[type=file] {
            opacity: 0;
        }
        .uploader-demo{
            position: absolute;
            top:-16px;
            opacity: 0;
        }
        .system-img {
            display: none;
            margin-right: 20px;
            width: 100px;
            position: relative;
        }

        .active {
            display: block;
        }

        .system-img img {
            width: 100%;
        }

        .app-content-id {
           position: relative;
        }

        .system-img i {
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
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">系统配置</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->

        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('system.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加配置</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>
                            </button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i
                                        class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="5%">
                            <div class="checkbox">
                                <input id="checkbox-all" class="magic-checkbox" type="checkbox">
                                <label for="checkbox-all"></label>
                            </div>
                        </th>
                        <th width="7%">排序</th>
                        <th width="15%">标题</th>
                        <th width="8%">名称</th>
                        <th width="45%">内容</th>
                        <th width="20%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($systems) > 0)
                        @foreach($systems as $v)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                               type="checkbox"
                                               value="{{$v->id}}" name="ids">
                                        <label for="demo-form-checkbox-{{$v->id}}"></label>
                                    </div>
                                </td>
                                <td><input type="text" value="{{$v->order}}" class="form-control" onblur='updateOrderById("{{route('system.update.order')}}","{{$v->id}}",this.value)'></td>
                                <td>{{$v->title}}</td>
                                <td>{{$v->name}}</td>
                                <td>
                                    @switch($v->type)
                                    @case('input')
                                    {!! Form::text('content',$v->content,['class'=>'form-control app-system-form','data-id'=>$v->id]) !!}
                                    @break
                                    @case('textarea')
                                    {!! Form::textarea('content',$v->content,['class'=>'form-control app-system-form','rows'=>'3','data-id'=>$v->id]) !!}
                                    @break
                                    @case('image')
                                    <div class="app-content-id" data-id="{{$v->id}}">
                                        <div class="pull-left system-img {{$v->content != '' ? 'active' : ''}}">
                                            <i class="fa fa-minus-circle app-remove-logo"
                                               data-path="{{$v->content}}" title="点击删除logo,重新上传"></i>
                                            <img src="{{asset($v->content)}}" alt="">
                                        </div>
                                        <div id="uploader-demo" class="pull-left">
                                            <div id="filePicker" class="btn btn-dark" data-id="{{$v->id}}">选择图片</div>
                                        </div>
                                    </div>
                                    @break
                                    @case('radio')
                                    <div class="radio">
                                        {!! Form::radio('value',1,$v->content == 1?'check':'',['class'=>'magic-radio app-site-state','id'=>'demo-form-inline-open','data-id'=>$v->id]) !!}
                                        <label for="demo-form-inline-open" class="mar-rgt pad-rgt">开启</label>
                                        &nbsp;&nbsp;
                                        {!! Form::radio('value',0,$v->content == 0?'check':'',['class'=>'magic-radio app-site-state','id'=>'demo-form-inline-off','data-id'=>$v->id]) !!}
                                        <label for="demo-form-inline-off" class="mar-rgt pad-rgt">关闭</label>
                                    </div>
                                    @break
                                    @default
                                    @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{route('system.edit',['id'=>$v->id])}}"
                                       class="btn btn-mint mar-rgt"><i
                                                class="fa fa-edit app-btn-i-margin-r-5"></i>编辑</a>
                                    <a href="javascript:;"
                                       onclick='deleteObj("{{URL::current()}}","{{$v->id}}","{{$v->name}}")'
                                       class="btn btn-danger"><i class="fa fa-trash app-btn-i-margin-r-5"></i>删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center text-danger">很抱歉,暂无数据(T_T)</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection

@section('my-js')
    <script src="{{asset('backend/plugins/webuploader/webuploader.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            if ($(".system-img").hasClass('active')){
                $(".uploader-demo").hide();
            }
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
        uploader.on('uploadSuccess', function (file, response) {
            if (response.success == true) {
                $(".system-img").show();
                $(".uploader-demo").hide();
                $(".system-img img").attr('src', '../' + response.data.path);
                $(".app-remove-logo").attr('data-path',response.data.path);
                updateContentById($(".app-content-id").data('id'), response.data.path);
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

        uploader.on('uploadComplete', function (file) {
            uploader.removeFile( file );
        });


        $(".app-remove-logo").click(function () {
            $.post("{{route('file.remove')}}", {
                _token: "{{csrf_token()}}",
                path: $(this).attr('data-path')
            }, function (response) {
                if (response.success == true) {
                    $(".system-img").hide();
                    $(".uploader-demo").css('opacity',1).show();
                    $(".app-remove-logo").attr('data-path','');
                    updateContentById($(".app-content-id").data('id'), '');
                }
            });

        });

        $(".app-site-state").change(function () {
            updateContentById($(this).data('id'), $(this).val());
        });

        $(".app-system-form").blur(function () {
            updateContentById($(this).data('id'), $(this).val());
        });


        function updateContentById(id, content) {
            $.post("{{route('system.updateContent')}}", {
                id: id,
                _token: "{{csrf_token()}}",
                content: content
            }, function (response) {
                if (response.success == true){
                    window.location.href = window.location.href;
                }

            })
        }
    </script>
@endsection
