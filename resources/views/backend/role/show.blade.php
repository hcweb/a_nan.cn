@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">添加角色</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body" style="padding-bottom: 10px;">
            <ul class="list-unstyled">
                <li class="col-sm-12">名称:<label>{{$role->name}}</label></li>
                <li class="col-sm-12">别名:<label>{{$role->alias}}</label></li>
                <li class="col-sm-12">描述:<label>{{$role->describe}}</label></li>
                <li class="col-sm-12">权限:
                    @if(count($role->permissions))
                        @foreach($role->permissions as $v)
                            <label class="mar-rgt"><i class="fa fa-tag"></i>{{$v->alias}}</label>
                        @endforeach
                    @endif
                </li>
            </ul>
        </div>
        <div class="panel-footer" style="padding-bottom: 20px;">
            <a class="btn btn-warning mar-rgt" href="javascript:history.go(-1)"><i
                        class="fa fa-undo app-btn-i-margin-r-5"></i>返回上一页</a>
        </div>
        <!--===================================================-->

    </div>
@endsection