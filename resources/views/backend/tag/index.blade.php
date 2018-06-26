@extends('layout.backend')
@section('content')
    <div id="addTags">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">标签管理</h3>
            </div>
            <!--Data Table-->
            <!--===================================================-->

            <div class="panel-body" style="padding-bottom: 0">
                <div class="pad-btm form-inline">
                    <div class="row">
                        <div class="col-sm-6 table-toolbar-left">
                            <button data-target="#demo-sm-modal" data-toggle="modal"
                                    class="btn btn-success mar-rgt"><i
                                        class="fa fa-plus app-btn-i-margin-r-5" data-target="#demo-sm-modal"
                                        data-toggle="modal"></i>添加标签
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-default toggleTitle" onclick="choseAll()"><i
                                            class="fa fa-check"></i><span>全选</span>
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
                            <th>
                                <div class="checkbox">
                                    <input id="checkbox-all" class="magic-checkbox" type="checkbox">
                                    <label for="checkbox-all"></label>
                                </div>
                            </th>
                            <th>标签名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($tags) > 0)
                            @foreach($tags as $v)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="demo-form-checkbox-{{$v->id}}"
                                                   class="magic-checkbox checkbox-one"
                                                   type="checkbox"
                                                   value="{{$v->id}}" name="ids">
                                            <label for="demo-form-checkbox-{{$v->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{$v->name}}"
                                                   ref="input{{$v->id}}"
                                                   v-on:blur='editTag("{{$v->id}}")'>
                                        </div>
                                        <span style="padding-top: 6px;opacity: .5;display: inline-block">tips:可以直接修改分类名称,失去焦点后自动保存,^_^!</span>
                                    </td>
                                    <td>
                                        {{$v->created_at}}
                                    </td>
                                    <td>
                                        <a href="javascript:;"
                                           onclick='deleteObj("tag","{{$v->id}}","{{$v->name}}")'
                                           class="btn btn-danger"><i
                                                    class="fa fa-trash app-btn-i-margin-r-5"></i>删除</a>
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
        </div>

        <div id="demo-sm-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                        </button>
                        <h4 class="modal-title" id="mySmallModalLabel">标签管理</h4>
                    </div>
                    <div class="modal-body">
                        <div class='form-group' :class="{'has-error':error != ''}">
                            {!! Form::text('name',old('name'),['class'=>'form-control link-cate-name','v-model'=>'name']) !!}
                            <span class="help-block">
                                @{{ error }}
                            </span>
                        </div>

                        <div class="clearfix"></div>
                        <div class="mar-top" style="overflow: hidden">
                            <button class="btn btn-primary pull-right app-save-link-cate" type="button"
                                    v-on:click="saveTag">保存
                            </button>
                            <button data-dismiss="modal" class="btn btn-default pull-right mar-rgt" type="button">取消
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('my-js')
    <script src="{{asset('backend/plugins/vue/vue.js')}}"></script>
    <script src="{{asset('backend/plugins/vue/axios.min.js')}}"></script>
    <script type="text/javascript">
        var vm = new Vue({
            el: '#addTags',
            data: {
                name: '',
                isActive: true,
                error: '',
            },
            methods: {
                saveTag: function () {
                    this.sendAjax(this.name, '');
                },
                sendAjax: function (name, id) {
                    axios.post("{{route('tag.create.and.update')}}", {
                        name: name,
                        id: id,
                        _token: "{{csrf_token()}}"
                    })
                        .then(function (response) {
                            if (response.data.success == true) {
                                $("#demo-sm-modal").modal('hide');
                                swal({
                                    title: '',
                                    text: response.data.message,
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
                                    text: response.data.message,
                                    type: 'error',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                            }
                            vm.error = '';
                        })
                        .catch(function (error) {
                            if (error.response != undefined) {
                                if (error.response.data.errors.name.length > 0) {
                                    vm.error = error.response.data.errors.name[0];
                                }
                                if (id != '') {
                                    swal({
                                        title: '',
                                        text: vm.error,
                                        type: 'error',
                                        timer: 2000,
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    });
                                }
                            } else {
                                $("#demo-sm-modal").modal('hide');
                                swal({
                                    title: '',
                                    text: '服务器错误!',
                                    type: 'error',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                            }
                        });
                },
                editTag: function (id) {
                    this.sendAjax(this.$refs['input' + id].value, id);
                }
            }
        });
    </script>
@endsection