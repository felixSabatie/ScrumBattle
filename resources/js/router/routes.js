import Projects from '../components/Projects';
import Project from '../components/Project';
import Register from '../components/auth/Register';
import Login from '../components/auth/Login';
import Game from '../components/Game';
import NotFound from '../components/NotFound';

export default [
    {
      path: '/projects',
      name: 'projects',
      component: Projects
    },
    {
        path: "/projects/:slug",
        name: "project",
        component: Project
    },
    {
        path: "/register",
        name: "register",
        component: Register
    },
    {
        path: "/login",
        name: "login",
        component: Login
    },
    {
        path:"/game",
        name: "game",
        component: Game
    },
    {
        path: '/',
        redirect: '/projects'
    },
    {
        path: '*',
        component: NotFound
    }
];
