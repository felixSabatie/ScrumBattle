
require('./bootstrap');
import VueRouter from 'vue-router';
import App from './components/App';
import Home from './components/Home';

window.Vue = require('vue');

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    }],
});

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
