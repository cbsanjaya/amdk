import Vue from 'vue';
import Base from './base';
import axios from 'axios';
import Routes from './routes';
import VueRouter from 'vue-router';

require('bootstrap');

let apiToken = document.head.querySelector('meta[name="api-token"]');

if (apiToken) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + apiToken.content;
}

Vue.use(VueRouter);

window.Popper = require('popper.js').default;

const router = new VueRouter({
    routes: Routes,
    mode: 'history',
    base: '/home/',
});

Vue.component('alert', require('./components/Alert.vue'));
Vue.component('index-screen', require('./components/IndexScreen.vue'));

Vue.mixin(Base);

new Vue({
    el: '#app',
    router,
    data(){
        return {
            alert: {
                type: null,
                autoClose: 0,
                message: '',
                confirmationProceed: null,
                confirmationCancel: null,
            },
        }
    },
});
