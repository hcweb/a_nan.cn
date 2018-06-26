@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">角色管理</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->

        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('role.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加角色</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span></button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除</button>
                        </div>
                    </div>
                    {!! Form::open(['route'=>'role.search']) !!}
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
                        <th>名称</th>
                        <th>别名</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($roles) > 0)
                        @foreach($roles as $v)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                               type="checkbox"
                                               value="{{$v->id}}" name="ids">
                                        <label for="demo-form-checkbox-{{$v->id}}"></label>
                                    </div>
                                </td>
                                <td>{{$v->name}}</td>
                                <td>{{$v->alias}}</td>
                                <td>{{$v->describe}}</td>
                                <td>
                                    <a href="{{route('role.show',['id'=>$v->id])}}" class="btn btn-warning mar-rgt"><i
                                                class="fa fa-eye app-btn-i-margin-r-5"></i>查看</a>
                                    <a href="{{route('role.edit',['id'=>$v->id])}}" class="btn btn-mint mar-rgt"><i
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
    <script type="text/javascript">

    </script>
@endsection