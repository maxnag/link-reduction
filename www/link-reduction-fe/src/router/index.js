import Vue from 'vue'
import VueRouter from 'vue-router'
import Form from '@/components/Form'
import Redirect from '@/components/Redirect'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Form',
            component: Form
        },
        {
            path: '*',
            name: 'Form',
            component: Form
        },
        {
            path: '/:key([0-9a-zA-Z]+)?',
            name: 'Redirect',
            component: Redirect
        }
    ]
});
