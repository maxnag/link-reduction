<template>
    <div>
        <p v-if="!errors.length">Redirecting...</p>

        <b-alert  variant="danger" v-else show fade>
            <p v-for='(error, index) in errors' :key='index'>
                <b>{{ error }}</b>
            </p>
        </b-alert>
    </div>
</template>

<script>
export default {
    name: 'Redirect',
    data () {
        return {
            errors: []
        }
    },
    mounted () {
        this.$nextTick(function () {
            this.getUrlByKey();
        })
    },
    methods: {
        getUrlByKey: function () {
            this.$http.get(process.env.API_URL + this.$route.params.key)
                .then(response => {
                    // success callback
                    window.location.href = response.body.url;
                }, errors => {
                    // error callback
                    if (errors.body && errors.body.message) {
                        this.errors = errors.body.message;
                    } else {
                        this.errors = ['No connection with the server'];
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
