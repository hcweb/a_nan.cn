<div class="col-lg-3 col-md-3" id="app-me">
    <div class="app-left-box">
        <div class="card border-0 mb-4">
            <img class="card-img-top" src="{!! block(6) !!}"
                 alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title text-center">
                    {{config('web-config.personAlais')}}
                </h5>
                <p class="text-center mb-0">{{config('web-config.personSkill')}}</p>
                <p class="text-center"><i class="fa fa-map-marker mr-1 text-muted"></i>
                    <small class="text-center text-muted">{{config('web-config.personAddress')}}</small>
                </p>
                <hr>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="d-flex align-items-center justify-content-center flex-column">
                            <small class="d-block text-muted">文章</small>
                            <strong class="d-block h4 mb-0 text-success">{{$postNum}}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-center flex-column">
                            <small class="d-block text-muted">标签</small>
                            <strong class="d-block h4 mb-0 text-warning">{{$tagNum}}</strong>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-sm-12 text-center">
                    <a href="#" class="fa fa-qq mr-2 text-muted"></a>
                    <a href="#" class="fa fa-weixin mr-2 text-muted"></a>
                    <a href="#" class="fa fa-weibo mr-2 text-muted"></a>
                    <a href="#" class="fa fa-github mr-2 text-muted"></a>
                </div>
            </div>
        </div>
    </div>
</div>