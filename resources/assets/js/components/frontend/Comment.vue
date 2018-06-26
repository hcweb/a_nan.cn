<template>
    <div>
        <div class="media mb-2" ref="comment_{{$v->id}}" data-current="{{$v->id}}" @mouseleave="showAskTitle=false" @mouseover="showAskTitleFun({{$v->id}})">
            <img class="mr-3 rounded" src="{{$v->member->avatar}}" alt="Generic placeholder image"
                 style="width: 3rem;height: 3rem;">
            <div class="media-body">
                <h6 class="mt-0 mb-0">
                    <label class="text-info text-success mr-2">{{$v->member->name}}</label>
                    <small class="mr-2 text-black-50">{{$v->visitor}}</small>
                    <small class="text-black-50 mr-2">{{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</small>
                    <small v-if="showAskTitle" class="text-danger mr-2" style="cursor: pointer" @click="toggleAsk">@{{ askTitle }}</small>
                </h6>
                <p  style="font-size: .9rem;margin-top: -.4rem;color: #444;">
                    {!! $v->content !!}
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    import HeaderComponent from './components/header.vue'
    import OtherComponent from './components/other.vue'
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        components:{
            'other-component':OtherComponent,
            HeaderComponent,
        }
    }
</script>
