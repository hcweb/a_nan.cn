@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">添加用户</h3>
        </div>
        {!! Form::open(['route'=>'user.store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
        <div class="panel-body" style="padding-bottom: 10px;">
            @include('backend.user.form')
        </div>
        <div class="panel-footer" style="padding-bottom: 20px;">
            <div class="col-sm-offset-2">
                <button class="btn btn-success mar-rgt" type="submit"><i class="fa fa-plus app-btn-i-margin-r-5"></i>添加
                </button>
                <button class="btn btn-mint mar-rgt" type="reset"><i class="fa fa-retweet app-btn-i-margin-r-5"></i>重置
                </button>
                <a class="btn btn-warning mar-rgt" href="javascript:history.go(-1)"><i
                            class="fa fa-undo app-btn-i-margin-r-5"></i>返回上一页</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @include('backend.user.modal')
@endsection
@section('my-js')
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/PekeUpload/pekeUpload.min.js')}}"></script>
    <script src="{{asset('backend/plugins/Jcrop/Jcrop.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.app-select').select2();
            var imgUrl = $("#user_avatar_url");

            $("#file_upload").pekeUpload({
                url: "{{route('user.avatar')}}",
                data: {
                    _token: "{{csrf_token()}}"
                },
                limit: 1,
                btnText: '上传图片',
                invalidExtError: '不支持的文件类型！',
                showPreview: false,
                showFilename: false,
                showPercent: false,
                showErrorAlerts: true,
                allowedExtensions: "jpeg|jpg|png|gif",
                onFileSuccess: function (file, data) {
                    if (data.success == 1) {
                        $("#avatar-crop").modal('show');
                        $("#avatar-tmp").attr('src', data.path);
                        $("#imgPth").val(data.imgPath);
                    }
                },
                onFileError: function (file, error) {
                    swal({
                        text: error,
                        title: '',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });

            $('#avatar-tmp').Jcrop({
                boxWidth: 435,
                aspectRatio: 1,
                setSelect: [100, 100, 130, 130]
            }, function () {
                thumbnail = this.initComponent('Thumbnailer', {width: 120, height: 120, parent: ".app-img-thumb"});
            });
            $('#interface').on('cropstart cropmove cropend', function (e, s, c) {
                $('#cropx').val(c.x);
                $('#cropy').val(c.y);
                $('#cropw').val(c.w);
                $('#croph').val(c.h);
            });

            $("#cropForm").submit(function () {
                $.post("{{route('user.avatar.crop')}}", $(this).serializeArray()).success(function (data, textStatus, jqXHR) {
                    if (data.success == 1) {
                        $("#avatar-crop").modal('hide');
                        imgUrl.val(data.path);
                        $("#user_avatar").show();
                        $("#user_avatar").find('img').attr('src', data.fullPath);
                    } else {
                        swal({
                            text: data.error,
                            title: '',
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }).error(function (xhr, errorText, errorType) {
                    $("#avatar-crop").modal('hide');
                    swal({
                        text: '服务器错误！',
                        title: '',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            });
        })
    </script>
@endsection