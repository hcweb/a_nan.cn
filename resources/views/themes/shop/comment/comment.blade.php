<div class="media mb-2" style="margin-left:{{$v->depth*30}}px">
	<img class="mr-3 rounded" src="{{$v->member->avatar}}" alt="Generic placeholder image"
		 style="width: 3rem;height: 3rem;">
	<div class="media-body">
		<h6 class="mt-0 mb-0">
			<label class="text-info text-success mr-2" style="font-size: 14px;">{{$v->member->name}}</label>
			<small class="mr-2 text-black-50">{{$v->city}}</small>
			<small class="text-black-50 mr-2">{{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</small>
			@if(auth()->guard('member')->check()&&auth()->guard('member')->user()->id != $v->member_id)
				 <small class="mr-2 float-right fa fa-reply" style="cursor: pointer;color:#dddddd;" title="回复" @click="reply({{$v->id}})"></small>
			@endif
		</h6>
		<p style="font-size: .9rem;margin-top: -.4rem;color: #444;">
			{!! $v->content !!}
		</p>
	</div>
</div>
@if($v->children)
	@include('comment.list',['comments'=>$v->children])
@endif