import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import PostsCreate from "./views/PostsCreate";
import PostsShow from "./views/PostsShow";
import PostsEdit from "./views/PostsEdit";
import PostsIndex from "./views/PostsIndex";
import Logout from "./Actions/Logout";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: ExampleComponent},
        { path: '/posts', component: PostsIndex},
        { path: '/posts/create', component: PostsCreate},
        { path: '/posts/:id', component: PostsShow},
        { path: '/posts/:id/edit', component: PostsEdit},
        { path: '/logout', component: Logout},
    ],
    mode: 'history',
});