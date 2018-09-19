<template>
    <div>
        <p v-if="success">Your short link is <a :href="shortLink" title="The short link" target="_blank">{{ shortLink }}</a></p>

        <form class="link-form" method="post" v-if="!success">
            <h1 class="h3 mb-3 font-weight-normal">Link Reduction Test Project</h1>
            <b-alert variant="danger" v-if="errors.length" show fade>
                <p v-for='(error, index) in errors' :key='index'>
                    <b>{{ error }}</b>
                </p>
            </b-alert>
            <input type="url" v-model="inputLink" id="inputLink" class="form-control" placeholder="Paste a link to shorten it" required autofocus size="4096">
            <button class="btn btn-lg btn-primary btn-block" type="button" v-on:click="createUrl" v-bind:disabled="loading">Shrink</button>
        </form>
    </div>

</template>

<script>
export default {
    name: 'Form',
    data () {
        return {
            inputLink: null,
            loading: false,
            success: false,
            errors: []
        }
    },
    methods: {
        createUrl: function () {
            const payload = {
                data: {
                    url: this.inputLink
                }
            };

            this.loading = true;

            this.$http.post(process.env.API_URL + 'create/url', JSON.stringify(payload), {emulateJSON: true}).then(response => {
                // success callback
                this.shortLink = window.location.href + response.body.key;
                this.loading = false;
                this.success = true;
            }, errors => {
                // error callback
                if (errors.body && errors.body.message) {
                    this.errors = errors.body.message;
                } else {
                    this.errors = ['No connection with the server'];
                }

                this.loading = false;
                this.success = false;
            });
        }
    }
}
</script>

<style>
    .link-form {
        width: 100%;
        max-width: 430px;
        padding: 15px;
        margin: auto;
    }
    .link-form .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .link-form .form-control:focus {
        z-index: 2;
    }
    .link-form input[type="url"] {
        margin-bottom: 10px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
