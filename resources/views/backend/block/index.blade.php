@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">自定义资料管理</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('block.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加资料</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span></button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除</button>
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
                        <th>标题</th>
                        <th>类型</th>
                        <th>调用方式</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($blocks) > 0)
                        @foreach($blocks as $v)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                               type="checkbox"
                                               value="{{$v->id}}" name="ids">
                                        <label for="demo-form-checkbox-{{$v->id}}"></label>
                                    </div>
                                </td>
                                <td>{{$v->title}}</td>
                                <td>
                                    @switch($v->type)
                                    @case('I')
                                        <span class="badge badge-info">图片</span>
                                      @break
                                    @case('E')
                                        <span class="badge badge-danger">编辑</span>
                                      @break
                                    @case('F')
                                        <span class="badge badge-pink">文字</span>
                                      @break
                                    @endswitch
                                </td>
                                <td>
                                @php
                                    echo "{!! block($v->id) !!}";
                                @endphp
                                </td>
                                <td>
                                    <a href="{{route('block.edit',['id'=>$v->id])}}" class="btn btn-mint mar-rgt"><i
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