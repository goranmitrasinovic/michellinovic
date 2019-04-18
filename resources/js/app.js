import Vue from 'vue'
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import axios from 'axios'

Vue.use(VueRouter)
Vue.use(Vuetify)

import App from './views/App'
import Shopping from './views/Shopping'
import Home from './views/Home'
import Competition from './views/Competition'

// import 'vuetify/dist/vuetify.min.css'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/shopping-list',
            name: 'shopping',
            component: Shopping,
        },
        {
            path: '/competition',
            name: 'competition',
            component: Competition,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
