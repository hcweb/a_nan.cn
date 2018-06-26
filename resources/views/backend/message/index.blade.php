@extends('layout.backend')
@section('my-css')
    <link href="{{asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">留言列表</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <div class="btn-group pull-left">
                            <button class="btn btn-default toggleTitle" onclick="choseAll()"><i class="fa fa-check"></i><span>全选</span>
                            </button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i
                                        class="fa fa-paste app-btn-i-margin-r-5"></i>审核
                            </button>
                            <button class="btn btn-default" onclick='deleteMoreObject("{{URL::current()}}")'><i
                                        class="fa fa-trash app-btn-i-margin-r-5"></i>批量删除
                            </button>
                        </div>
                        <div class="pull-left col-sm-2" id="app-select2">
                            {!! Form::select('parent_id',[2=>'所有属性',0=>'未审核',1=>'已审核'],2,['class'=>'form-control app-select']) !!}
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
                <div class="timeline">
                    <div class="timeline-entry" style="position: relative;">
                        <div class="checkbox bg-light" style="position: absolute;left: 0;top: 0;">
                            <input id="demo-form-checkbox-" class="magic-checkbox checkbox-one"
                                   type="checkbox"
                                   value="" name="ids">
                            <label for="demo-form-checkbox-"></label>
                        </div>
                        <div class="timeline-stat">
                            <div class="timeline-icon"><i class="demo-pli-office icon-2x"></i></div>
                            <div class="timeline-time">2 Hours ago</div>
                        </div>
                        <div class="timeline-label">
                            <p class="text-bold"><a href="#" class="text-warning">Job Meeting</a></p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.
                        </div>
                    </div>
                    <div class="timeline-entry" style="position: relative;">
                        <div class="checkbox bg-light" style="position: absolute;left: 0;top: 0;">
                            <input id="demo-form-checkbox-" class="magic-checkbox checkbox-one"
                                   type="checkbox"
                                   value="" name="ids">
                            <label for="demo-form-checkbox-"></label>
                        </div>
                        <div class="timeline-stat">
                            <div class="timeline-icon"><img src="img/profile-photos/10.png" alt="Profile picture">
                            </div>
                            <div class="timeline-time">3 Hours ago</div>
                        </div>
                        <div class="timeline-label">
                            <p class="mar-no pad-btm">
                                <a href="#" class="btn-link">Lisa D.</a> commented on
                                <a href="#" class="text-semibold"><i>The Article.</i></a>
                            </p>
                            <blockquote class="bq-sm bq-open mar-no">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</blockquote>
                        </div>
                    </div>
                    <div class="timeline-entry" style="position: relative;">
                        <div class="checkbox bg-light" style="position: absolute;left: 0;top: 0;">
                            <input id="demo-form-checkbox-" class="magic-checkbox checkbox-one"
                                   type="checkbox"
                                   value="" name="ids">
                            <label for="demo-form-checkbox-"></label>
                        </div>
                        <div class="timeline-stat">
                            <div class="timeline-icon"><i class="demo-pli-office icon-2x"></i></div>
                            <div class="timeline-time">2 Hours ago</div>
                        </div>
                        <div class="timeline-label">
                            <p class="text-bold"><a href="#" class="text-warning">Job Meeting</a></p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.
                        </div>
                    </div>
                    <div class="timeline-entry" style="position: relative;">
                        <div class="checkbox bg-light" style="position: absolute;left: 0;top: 0;">
                            <input id="demo-form-checkbox-" class="magic-checkbox checkbox-one"
                                   type="checkbox"
                                   value="" name="ids">
                            <label for="demo-form-checkbox-"></label>
                        </div>
                        <div class="timeline-stat">
                            <div class="timeline-icon"><img src="img/profile-photos/10.png" alt="Profile picture">
                            </div>
                            <div class="timeline-time">3 Hours ago</div>
                        </div>
                        <div class="timeline-label">
                            <p class="mar-no pad-btm">
                                <a href="#" class="btn-link">Lisa D.</a> commented on
                                <a href="#" class="text-semibold"><i>The Article.</i></a>
                            </p>
                            <blockquote class="bq-sm bq-open mar-no">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>
@endsection
@section('my-js')
    <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.app-select').select2(
                {
                    minimumResultsForSearch: -1
                }
            );
        });
    </script>
@endsection