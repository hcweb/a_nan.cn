@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">数据库还原</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->

        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="javascript:;" id="export" class="btn btn-primary mar-rgt">立即还原</a>
                        {{--<div class="btn-group">--}}
                        {{--<button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>--}}
                        {{--</button>--}}
                        {{--<button class="btn btn-default" id="optimize"><span>优化表</span></button>--}}
                        {{--<button class="btn btn-default" id="repair"><span>修复表</span></button>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                {!! Form::open(['url' => 'backend/database_export', 'method' => 'POST','id'=>'export-form']) !!}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>

                        </th>
                        <th>备份名称</th>
                        <th>卷数</th>
                        <th>压缩</th>
                        <th>数据大小</th>
                        <th>备份时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($lists) > 0)
                        @foreach($lists as $k=>$v)
                            <tr>
                                <td>
                                    <div class="radio">
                                        <input id="demo-form-checkbox-{{$v['time']}}"
                                               class="magic-radio"
                                               type="radio"
                                               value="{{$v['time']}}" name="import_radio">
                                        <label for="demo-form-checkbox-{{$v['time']}}"></label>
                                    </div>
                                </td>
                                <td class="text-info">{{date('Ymd-His',$v['time'])}}</td>
                                <td>{{$v['part']}}</td>
                                <td>{{$v['compress']}}</td>
                                <td>{{format_bytes($v['size'])}}</td>
                                <td>{{$k}}</td>
                                <td class="info_{{$v['time']}}">-</td>
                                <td>
                                    <a href="javascript:;" onclick="revert('{{$v["time"]}}')"
                                       class="btn btn-warning mar-rgt">还原</a>
                                    <a href="javascript:;" onclick="deleteFile('{{$v["time"]}}')"
                                       class="btn btn-danger mar-rgt">删除</a>
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
                {!! Form::close() !!}
            </div>
        </div>

        <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        function deleteFile(time) {
            swal({
                title: "您确定要删除所选项吗?",
                text: "删除后将不可恢复,请谨慎操作！",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定删除",
                cancelButtonText: "取消删除",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.get("{{url('backend/database_del_file')}}" + '/' + time, {
                        _token: config.token
                    }).success(function (response) {
                        if (response.success == true) {
                            swal({
                                title: '',
                                text: response.msg,
                                type: 'success',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function () {
                                window.location.href = window.location.href;
                            }, 1000);
                        } else {
                            swal({
                                title: '',
                                text: response.msg,
                                type: 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        }
                    }).error(function () {
                        swal({
                            title: '',
                            text: '服务器错误！',
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    });
                }
            });
        }

        function revert(time) {
            var self = this;
            $.get("{{url('backend/database_import')}}", {
                time: time,
                _token: config.token
            }).success(function (response) {
                if (response.success && response.part) {
                    $(".info_" + time).text(response.msg);
                    $.get("{{url('backend/database_import')}}", {
                        'part': response.part,
                        'start': response.start,
                        _token: config.token
                    })
                        .success(function (data) {
                            if (data.code == 1) {
                                $(".info_" + time).text(data.msg);
                            } else {
                                swal({
                                    title: '',
                                    text: data.msg,
                                    type: 'error',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
                            }
                            console.log(data);
                        })
                        .error(function () {
                            swal({
                                title: '',
                                text: '服务器错误！',
                                type: 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        });
                } else {
                    swal({
                        title: '',
                        text: response.msg,
                        type: 'error',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                }
            })
                .error(function () {
                    swal({
                        title: '',
                        text: '服务器错误！',
                        type: 'error',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                });
        }
    </script>
@endsection