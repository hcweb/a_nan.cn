@extends('layout.backend')
@section('content')
    <div class="tab-base">

        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#link-list" aria-expanded="true">链接列表</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#link-category" aria-expanded="false">链接分类</a>
            </li>
        </ul>

        <!--Tabs Content-->
        <div class="tab-content">
            <div id="link-list" class="tab-pane fade active in">
                <div class="panel">
                    <div class="panel-body" style="padding-bottom: 0">
                        <div class="pad-btm form-inline">
                            <div class="row">
                                <div class="col-sm-6 table-toolbar-left">
                                    <a href="{{route('link.create')}}" class="btn btn-primary mar-rgt"><i
                                                class="fa fa-plus app-btn-i-margin-r-5"></i>添加友情链接</a>
                                    <div class="btn-group">
                                        <button class="btn btn-default toggleTitle" onclick="choseAll()"><i
                                                    class="fa fa-check"></i><span>全选</span></button>
                                        <button class="btn btn-default"
                                                onclick='deleteMoreObject("{{URL::current()}}")'><i
                                                    class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除
                                        </button>
                                    </div>
                                </div>
                                {!! Form::open(['route'=>'link.search']) !!}
                                <div class="col-sm-6 table-toolbar-right">
                                    <div class="input-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                                        <input placeholder="请输入标题名称查询" class="form-control" type="text" name="keywords">
                                        <span class="input-group-btn">
					              <button class="btn btn-mint" type="submit">搜索</button>
					        </span>
                                        @if($errors->has('keywords'))
                                            @php
                                                alert()->error('erter',$errors->first('keywords'))
                                            @endphp
                                        @endif

                                    </div>

                                </div>
                                {!! Form::close() !!}
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
                                    <th>排序</th>
                                    <th colspan="8">基本信息</th>
                                    <th>显示状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($links) > 0)
                                    @foreach($links as $v)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="demo-form-checkbox-{{$v->id}}"
                                                           class="magic-checkbox checkbox-one" type="checkbox"
                                                           value="{{$v->id}}" name="ids">
                                                    <label for="demo-form-checkbox-{{$v->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-center"
                                                       value="{{$v->order}}"
                                                       style="width: 50px;"
                                                       onblur='updateOrderById("{{route('link.update.order')}}","{{$v->id}}",this.value)'>
                                            </td>
                                            <td colspan="8">
                                                <div style="position: relative;">
                                                    <p>标题：{{$v->title}}</p>
                                                    <p>所属分类：{{$v->link->name}}</p>
                                                    <p>链接地址：{{$v->url}}</p>
                                                    <p>用户名：{{$v->user_name}}</p>
                                                    <p> 邮箱：{{$v->user_email}}</p>
                                                    <p>手机号：{{$v->user_phone}}</p>
                                                    <p>简短描述：{{$v->description}}</p>
                                                    <img src="{{asset($v->logo)}}" alt="" class="img-circle img-sm"
                                                         style="position: absolute;right: 60px;top: 75px;">
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge {{$v->is_show === 1 ? 'badge-success' : 'badge-black'}}">{{$v->is_show === 1 ? '显示' : '隐藏'}}</span>
                                            </td>

                                            <td>
                                                <a href="{{route('link.edit',['id'=>$v->id])}}"
                                                   class="btn btn-mint mar-rgt"><i
                                                            class="fa fa-edit app-btn-i-margin-r-5"></i>编辑</a>
                                                <a href="javascript:;"
                                                   onclick='deleteObj("{{URL::current()}}","{{$v->id}}","{{$v->title}}")'
                                                   class="btn btn-danger"><i
                                                            class="fa fa-trash app-btn-i-margin-r-5"></i>删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center text-danger">很抱歉,暂无数据(T_T)</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            {{$links->links()}}
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End Data Table-->
                </div>
            </div>
            <div id="link-category" class="tab-pane fade">
                <div class="panel">
                    <div class="panel-body" style="padding-bottom: 0">
                        <div class="pad-btm form-inline">
                            <div class="row">
                                <div class="col-sm-6 table-toolbar-left">
                                    <button data-target="#demo-sm-modal" data-toggle="modal"
                                            class="btn btn-success mar-rgt"><i
                                                class="fa fa-plus app-btn-i-margin-r-5" data-target="#demo-sm-modal"
                                                data-toggle="modal"></i>添加分类
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>分类名称</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($linkCates) > 0)
                                    @foreach($linkCates as $v)
                                        <tr>
                                            <td>
                                                {{$v->id}}
                                            </td>
                                            <td>
                                                <div class="col-sm-5">
                                                    <input type="text" data-id="{{$v->id}}"
                                                           class="form-control app-link-cate-value"
                                                           value="{{$v->name}}">
                                                </div>
                                                <span style="padding-top: 6px;opacity: .5;display: inline-block">tips:可以直接修改分类名称,失去焦点后自动保存,^_^!</span>
                                            </td>
                                            <td>
                                                {{$v->created_at}}
                                            </td>
                                            <td>
                                                <a href="javascript:;"
                                                   onclick='deleteObj("link/destroy","{{$v->id}}","{{$v->name}}")'
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

                    <!--===================================================-->
                    <!--End Data Table-->
                </div>
            </div>
        </div>
    </div>

    <div id="demo-sm-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title" id="mySmallModalLabel">友情链接分类</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::text('name',old('name'),['class'=>'form-control link-cate-name']) !!}
                        <span class="help-block"></span>
                    </div>

                    <div class="clearfix"></div>
                    <div class="mar-top" style="overflow: hidden">
                        <button class="btn btn-primary pull-right app-save-link-cate" type="button">保存</button>
                        <button data-dismiss="modal" class="btn btn-default pull-right mar-rgt" type="button">取消
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        var linkCateName = $('.link-cate-name');
        linkCateName.change(function () {
            if ($(this).val() != '') {
                linkCateName.parent().removeClass('has-error');
                linkCateName.next('span').hide().text();
            }
        });
        $(function () {
            $(".app-save-link-cate").click(function () {
                if (linkCateName.val() == '') {
                    linkCateName.parent().addClass('has-error');
                    linkCateName.next('span').text('友情链接分类不能为空!');
                    return;
                }
                $('#demo-sm-modal').modal('hide');
                createAndUpdateLink(null, $('.link-cate-name').val())
            });


            function createAndUpdateLink(id, name) {
                $.post("{{route('create.linkCategory')}}", {
                    _token: "{{csrf_token()}}",
                    name: name,
                    id: id
                }, function (response) {
                    if (response.success == true) {
                        swal({
                            title: '',
                            text: response.message,
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);

                    } else {
                        swal({
                            title: '',
                            text: response.message,
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                });
            }

            $(".app-link-cate-value").blur(function () {
                createAndUpdateLink($(this).attr('data-id'), $(this).val())
            });
        })
    </script>
@endsection