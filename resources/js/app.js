
require('./bootstrap');
import VueRouter from 'vue-router';
import App from './components/App';
import Project from './components/Project';
import Register from './components/auth/Register';
import Login from './components/auth/Login';

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
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    }
  ],
});

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
