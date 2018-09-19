<template>
    <router-view/>
</template>

<script>
export default {
    name: 'App'
}
</script>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    div.alert p {
        margin: 0;
    }
</style>
