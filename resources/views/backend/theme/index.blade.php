@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">主题列表</h3>
        </div>
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('theme.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加主题</a>
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
                <table class="table table-striped mar-no">
                    <thead>
                    <tr>
                        <th>
                            <div class="checkbox">
                                <input id="checkbox-all" class="magic-checkbox" type="checkbox">
                                <label for="checkbox-all"></label>
                            </div>
                        </th>
                        <th>模板名称</th>
                        <th>作者</th>
                        <th>创建日期</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($themes)>0)
                        @foreach($themes as $k=>$v)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                               type="checkbox" value="{{$v->id}}" name="ids">
                                        <label for="demo-form-checkbox-{{$v->id}}"></label>
                                    </div>
                                </td>
                                <td>{{$v->title}}({{$v->theme}})</td>
                                <td>{{$v->username}}</td>
                                <td>{{$v->created_at}}</td>
                                <td><label class="badge {{$v->is_enabled == 1 ? 'badge-success' : 'badge-black'}}"
                                           onclick="setTheme({{$v->id}},{{$v->is_enabled}})">{{$v->is_enabled == 1 ?'禁用此主题' :'启用此主题'}}</label>
                                </td>
                                <td>
                                    <a href="{{route('theme.edit',['id'=>$v->id])}}" class="btn btn-mint mar-rgt"><i
                                                class="fa fa-edit app-btn-i-margin-r-5"></i>编辑</a>
                                    <a href="javascript:;"
                                       onclick='deleteObj("{{URL::current()}}","{{$v->id}}","{{$v->name}}")'
                                       class="btn btn-danger"><i class="fa fa-trash app-btn-i-margin-r-5"></i>删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-danger">很抱歉,暂无数据(T_T)</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('my-js')
    <script type="text/javascript">
        function setTheme(id, state) {
            if (state == 0) {
                var isCan ="{{in_array(1,$states)}}";
                if (isCan == "1") {
                    swal({
                        title: '',
                        text: '请先禁用正在使用的主题！',
                        type: 'info',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                } else {
                    $.post("{{route('theme.update')}}", {
                        id: id,
                        is_enabled: 1,
                        _token:"{{csrf_token()}}"
                    }, function (response) {
                        if (response.success == true) {
                            swal({
                                title: '',
                                text: '主题启用成功！',
                                type: 'success',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function () {
                                window.location.href = window.location.href
                            }, 1000);
                        } else {
                            swal({
                                title: '',
                                text: '主题启用失败！',
                                type: 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        }
                    });
                }

            }

            if (state == 1) {
                swal({
                    title: '',
                    text: '禁用后无法预览前端界面！',
                    type: 'error',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonText: "确定",
                    cancelButtonText: "取消"
                }, function (isConfirm) {
                    $.post("{{route('theme.update')}}", {
                        id: id,
                        is_enabled: 0,
                        _token:"{{csrf_token()}}"
                    }, function (response) {
                        if (response.success == true) {
                            swal({
                                title: '',
                                text: '主题禁用成功！',
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
                                text: '主题禁用失败！',
                                type: 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        }
                    });
                });
            }
        }
    </script>
@endsection