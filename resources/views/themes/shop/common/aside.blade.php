<div class="col-lg-3 col-md-3 position-relative app-aside">
    <div class="app-right-box">
        <div class="card border-0  mb-4" id="hot-article">
            <div class="card-header bg-white app-card-header position-relative">
                <i></i>
                <h5 class="mb-0">热门文章</h5>
                <span class="rounded-circle"></span>
                <span class="rounded-circle"></span>
            </div>
            <ul class="list-group list-group-flush pb-3">
                @foreach($hotPosts as $v)
                    <li class="list-group-item border-0 text-truncate pb-0"><i>{{$loop->index+1}}</i><a
                                href="{{route('front.post.detail',['alias'=>$v->alias])}}"
                                class="text-nowrap text-muted animal">{{$v->title}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="card border-0 mb-4" id="hot-article">
            <div class="card-header bg-white app-card-header position-relative">
                <i></i>
                <h5 class="mb-0">热门标签</h5>
                <span class="rounded-circle"></span>
                <span class="rounded-circle"></span>
            </div>
            <ul class="pb-3 list-unstyled mb-0" id="app-tags">
                @foreach($tags as $v)
                    <a href="{{url('tag/'.$v->name)}}" class="border rounded animal">{{$v->name}}</a>
                @endforeach
            </ul>
        </div>
    </div>
</div>