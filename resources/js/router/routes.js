import Project from '../components/Project';
import Register from '../components/auth/Register';
import Login from '../components/auth/Login';


export default [
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
    }
];
