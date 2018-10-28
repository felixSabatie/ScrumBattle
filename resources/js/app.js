
require('./bootstrap');
import VueCookies from 'vue-cookies'
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import App from './components/App';

import store from './store';
import router from './router';


window.Vue = require('vue');

Vue.use(VueCookies)
Vue.use(VueRouter);
Vue.use(Vuex)

const app = new Vue({
    el: '#app',
    components: {App},
    router,
    store,
});
