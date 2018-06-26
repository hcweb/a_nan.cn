@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">用户列表</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('user.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加用户</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>
                            </button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i
                                        class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除
                            </button>
                        </div>
                    </div>
                    {!! Form::open(['route'=>'user.search']) !!}
                    <div class="col-sm-6 table-toolbar-right">
                        <div class="input-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                            <input placeholder="请输入用户名称查询" class="form-control" type="text" name="keywords">
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
                        <th>ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>头像</th>
                        <th>状态</th>
                        <th>角色</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $v)
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one"
                                           type="checkbox" value="{{$v->id}}" name="ids">
                                    <label for="demo-form-checkbox-{{$v->id}}"></label>
                                </div>
                            </td>
                            <td>{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->email}}</td>
                            <td><img src="{{asset($v->avatar)}}" alt="{{$v->name}}" class="img-circle" width="40"
                                     height="40">
                            </td>
                            <td>
                                <div class="label {{$v->is_enabled==1?'label-success':'label-danger'}}">{{$v->is_enabled==1?'启用':'禁用'}}</div>
                            </td>
                            <td>
                                @foreach($v->getRoleNames() as $role)
                                    {{$v->getAliasByRoleName($role)}}
                                @endforeach
                            </td>
                            <td>{{$v->created_at}}</td>
                            <td>
                                <a href="{{route('user.show',['id'=>$v->id])}}" class="btn btn-warning mar-rgt"><i
                                            class="fa fa-eye app-btn-i-margin-r-5"></i>查看</a>
                                <a href="{{route('user.edit',['id'=>$v->id])}}" class="btn btn-mint mar-rgt"><i
                                            class="fa fa-edit app-btn-i-margin-r-5"></i>编辑</a>
                                    <a href="javascript:;"
                                       onclick='deleteObj("{{URL::current()}}","{{$v->id}}","{{$v->name}}")'
                                       class="btn btn-danger"><i class="fa fa-trash app-btn-i-margin-r-5"></i>删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection