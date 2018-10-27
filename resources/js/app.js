
require('./bootstrap');
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import App from './components/App';
import Project from './components/Project';
import store from './store';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex)

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/projects/:slug',
        name: 'project',
        component: Project
    }],
});

const app = new Vue({
    el: '#app',
    components: {App},
    router,
    store,
});
