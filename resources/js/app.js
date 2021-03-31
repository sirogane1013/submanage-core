import './bootstrap'
import './router'

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './App.vue'
import router from './router'
import store from './store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

new Vue({
    el: '#app',
    render: h => h(App),
    router: router,
    data: {
        state: store.state,
    },
    created() {
        axios.get('/api/session-check').then(response => {
            if (response.status == 200)
                store.login();
        });
    },
})