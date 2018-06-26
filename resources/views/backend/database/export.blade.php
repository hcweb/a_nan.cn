@extends('layout.backend')
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">数据库备份</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->

        <div class="panel-body" style="padding-bottom: 0">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <a href="javascript:;" id="export" class="btn btn-primary mar-rgt">立即备份</a>
                        <div class="btn-group">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>
                            </button>
                            <button class="btn btn-default" id="optimize"><span>优化表</span></button>
                            <button class="btn btn-default" id="repair"><span>修复表</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                {!! Form::open(['url' => 'backend/database_export', 'method' => 'POST','id'=>'export-form']) !!}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <div class="checkbox">
                                <input id="checkbox-all" class="magic-checkbox" type="checkbox">
                                <label for="checkbox-all"></label>
                            </div>
                        </th>
                        <th>表名</th>
                        <th>数据量</th>
                        <th>数据大小</th>
                        <th>创建时间</th>
                        <th>备份状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($lists) > 0)
                        @foreach($lists as $v)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="demo-form-checkbox-{{$v['name']}}"
                                               class="magic-checkbox checkbox-one"
                                               type="checkbox"
                                               value="{{$v['name']}}" name="tables[]">
                                        <label for="demo-form-checkbox-{{$v['name']}}"></label>
                                    </div>
                                </td>
                                <td class="text-info">{{$v['name']}}</td>
                                <td>{{$v['rows']}}</td>
                                <td>{{format_bytes($v['data_length'])}}</td>
                                <td>{{$v['create_time']}}</td>
                                <td>未备份</td>
                                <td>
                                    <a href="" class="btn btn-warning mar-rgt">优化表</a>
                                    <a href="" class="btn btn-mint mar-rgt">修复表</a>
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
        (function($){
            var $form = $("#export-form"), $export = $("#export"), tables
            $optimize = $("#optimize"), $repair = $("#repair");
            $optimize.add($repair).click(function(){
                $.post(this.href, $form.serialize(), function(data){
                    if(data.status){
                        updateAlert(data.info,'alert-success');
                    } else {
                        updateAlert(data.info,'alert-error');
                    }
                }, "json");
                return false;
            });
            $export.click(function(){
                $export.parent().children().addClass("disabled");
                $export.html("正在发送备份请求...");
                $.post(
                    $form.attr("action"),
                    $form.serialize(),
                    function(data){
                        console.log(data);
                        if(data.code == 1){
                            tables = data.tables;
                            $export.html(data.msg + "开始备份，请不要关闭本页面！");
                            backup(data.tab);
                            window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                        } else {
//                            updateAlert(data.info,'alert-error');
                            $export.parent().children().removeClass("disabled");
                            $export.html("立即备份");
                        }
                    },
                    "json"
                );
                return false;
            });
            function backup(tab, status){
                status && showmsg(tab.id, "开始备份...(0%)");
                $.get($form.attr("action"), tab, function(data){
                    console.log(123);
                    console.log(data);
                    if(data.code == 1){
                        showmsg(tab.id, data.msg);
                        if(!$.isPlainObject(data.tab)){
                            $export.parent().children().removeClass("disabled");
                            $export.html("备份完成，点击重新备份");
                            window.onbeforeunload = function(){ return null }
                            return;
                        }
                        backup(data.tab, tab.id != data.tab.id);
                    } else {
//                        updateAlert(data.info,'alert-error');
                        $export.parent().children().removeClass("disabled");
                        $export.html("立即备份");
                    }
                }, "json");
            }
            function showmsg(id, msg){
                $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
            }
        })(jQuery);
    </script>
@endsection