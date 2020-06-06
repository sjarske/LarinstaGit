import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import PostsCreate from "./views/PostsCreate";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: ExampleComponent},
        { path: '/posts/create', component: PostsCreate}
    ],
    mode: 'history',
});