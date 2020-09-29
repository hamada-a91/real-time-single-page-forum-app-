import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
const routes = [
    { path: '/login', component: Login },
]

const router = new VueRouter({
    routes,
    hashbang: false,  //remove hash from url
    mode: 'history',
})

export default router;