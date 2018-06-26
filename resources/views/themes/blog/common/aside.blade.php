<div class="col-md-3 ml-auto mr-auto">
    <div class="card card-profile car-no-shadow" style="margin-top: 80px;">
        <div class="card-avatar">
            <a href="#pablo">
                <img class="img img-raised" src="{{asset( block(4) )}}">
            </a>
        </div>
        <div class="card-body">
            <a href="pablo">
                <h4 class="card-title">xtn</h4>
            </a>

            <h6 class="card-category text-info">
                WEB前端工程师
            </h6>
            <div class="card-footer">
                <a href="javascript:;" class="btn btn-icon btn-neutral btn-lg btn-twitter"><i
                            class="fa fa-qq"></i></a>
                <a href="javascript:;" class="btn btn-icon btn-neutral btn-lg btn-danger"><i
                            class="fa fa-weibo"></i></a>
                <a href="javascript:;" class="btn btn-icon btn-neutral btn-lg btn-success"><i
                            class="fa fa-weixin"></i></a>

            </div>
        </div>
    </div>
    <div class="bg-white app-hot-tags">
        <h4>热门标签</h4>
        <div class="col-md-12">
            @foreach($tags as $v)
                <a href="#" class="">{{$v->name}}</a>
            @endforeach
        </div>
    </div>
    <div class="bg-white app-hot-posts">
        <h4>热门文章</h4>
        <div class="col-md-12">
            <ul class="list-unstyled" style="overflow: hidden;display: block;">
                @foreach($hotPosts as $v)
                    <li>
                        <i>{{$loop->index+1}}</i><a href="{{route('front.post.detail',['alias'=>$v->alias])}}" class=""
                                                    title="{{$v->title}}">{{$v->title}}</a>
                    </li>
                @endforeach

            </ul>

        </div>
    </div>
</div>