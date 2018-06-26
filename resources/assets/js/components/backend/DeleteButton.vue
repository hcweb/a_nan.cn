<template>
    <div>
        <button class="btn btn-danger">{{title}}</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.name)
        },
        data:function () {
            return {
                title:'123'
            }
        },
        props:['title'],
    }
</script>