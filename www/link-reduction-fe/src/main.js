import Vue from 'vue'
import App from './App'
import router from './router'
import VueResource from 'vue-resource'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(VueResource);
Vue.config.productionTip = false;
Vue.http.options.emulateJSON = true;

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    components: { App },
    template: '<App/>'
});

Vue.http.interceptors.push(function (request, next) {
    request.credentials = false;
    request.headers.set('Accept', 'application/vnd.api.v1+json');
    request.headers.set('Content-Type', 'application/vnd.api.v1+json; charset=UTF-8');

    next();
});
