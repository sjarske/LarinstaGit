import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import PostsCreate from "./views/PostsCreate";
import PostsShow from "./views/PostsShow";
import PostsEdit from "./views/PostsEdit";
import PostsIndex from "./views/PostsIndex";
import Logout from "./Actions/Logout";
import ProfilesIndex from "./views/ProfilesIndex";
import ProfilesShow from "./views/ProfilesShow";
import FollowButton from "./components/FollowButton";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: ExampleComponent},
        { path: '/posts', component: PostsIndex},
        { path: '/posts/create', component: PostsCreate},
        { path: '/posts/:id', component: PostsShow},
        { path: '/posts/:id/edit', component: PostsEdit},
        { path: '/logout', component: Logout},

        { path: '/profiles', component: ProfilesIndex},
        { path: '/profiles/:id', component: ProfilesShow},

        { path: '/follow', component: FollowButton},
    ],
    mode: 'history',
});