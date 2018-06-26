<template>
    <input type="text" class="form-control text-center" v-model.trim="order" style="width: 50px;" @blur="sendOrder">
</template>

<script>
    export default {
        mounted() {
            this.order = this.orderValue,
                this.url = this.requestUrl,
                this.id = this.paramId
        },
        data: function () {
            return {
                order: 0,
                url: '',
                id: 0,
                token: window.hcweb.csrfToken
            }
        },
        props: ['orderValue', 'requestUrl', 'paramId'],
        methods: {
            sendOrder: function () {
                $.post(this.url, {
                    id: this.id,
                    order: this.order,
                    _token: this.token
                }, function (respose) {

                });
            }
        }
    }
</script>