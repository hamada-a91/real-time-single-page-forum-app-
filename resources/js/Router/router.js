import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import Logout from '../components/login/Logout'
import Signup from '../components/login/signup'
import Forum from '../components/forum/Forum'
import Read from '../components/forum/read'
import Create from '../components/forum/create'
import CreateCategory from '../components/forum/category/CreateCategory'





const routes = [
    { path: '/login', component: Login },
    { path: '/logout', component: Logout },
    { path: '/signup', component: Signup },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/question/:slug', component: Read, name: 'read' },
    { path: '/ask', component: Create, name: 'create' },
    { path: '/category', component: CreateCategory },





]

const router = new VueRouter({
    routes,
    hashbang: false,  //remove hash from url
    mode: 'history',
})

export default router;