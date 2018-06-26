@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">前台菜单</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->

        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="{{route('category.create')}}" class="btn btn-primary mar-rgt"><i
                                    class="fa fa-plus app-btn-i-margin-r-5"></i>添加菜单</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span></button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除</button>
                        </div>
                    </div>
                    {!! Form::open(['route'=>'category.search']) !!}
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
                        <th>图标</th>
                        <th>标题</th>
                        <th>别名</th>
                        <th>打开方式</th>
                        <th>显示状态</th>
                        <th>字体颜色</th>
                        <th>路由名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($categorys) > 0)
                        @foreach($categorys as $v)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="demo-form-checkbox-{{$v->id}}" class="magic-checkbox checkbox-one" type="checkbox"
                                               value="{{$v->id}}" name="ids">
                                        <label for="demo-form-checkbox-{{$v->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" value="{{$v->order}}"
                                           style="width: 50px;"
                                           onblur='updateOrderById("{{route('category.update.order')}}","{{$v->id}}",this.value)'>
                                </td>
                                <td><i class="{{$v->icon_class}} fa-1x"></i></td>
                                <td>
                                    <i style="margin-right: {{$v->level*10}}px"></i>
                                    <i class="fa fa-file text-muted"></i>
                                    <span style="margin-right: 5px;">{{str_repeat('-',$v->depth*5)}}</span>
                                    {{$v->title}}
                                </td>
                                <td>{{$v->alias}}</td>
                                <td>
                                    @switch($v->target)
                                    @case('_self')
                                    本页打开
                                    @break
                                    @case('_blank')
                                    新窗体中打开
                                    @break
                                    @case('_parent')
                                    父窗体中打开
                                    @break
                                    @endswitch
                                </td>
                                <td>
                                    <span class="badge {{$v->is_show === 1 ? 'badge-success' : 'badge-black'}}">{{$v->is_show === 1 ? '显示' : '隐藏'}}</span>
                                </td>
                                <td><span class="icon-circle icon-wrap" style="background-color: {{$v->color}}"></span>
                                </td>
                                <td>{{$v->route}}</td>
                                <td>
                                    <a href="{{route('category.edit',['id'=>$v->id])}}" class="btn btn-mint mar-rgt"><i
                                                class="fa fa-edit app-btn-i-margin-r-5"></i>编辑</a>
                                    <a href="javascript:;" onclick='deleteObj("{{URL::current()}}","{{$v->id}}","{{$v->title}}")'
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