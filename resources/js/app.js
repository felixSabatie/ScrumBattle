
require('./bootstrap');
import VueRouter from 'vue-router';
import App from './components/App';
import Project from './components/Project';
import Register from './components/auth/Register';

window.Vue = require('vue');

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/projects/:slug',
      name: 'project',
      component: Project
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    }
  ],
});

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
