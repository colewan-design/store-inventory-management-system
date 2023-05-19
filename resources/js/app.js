require('./bootstrap');

window.Vue = require('vue');
import  Vue from 'vue'
import  VueRouter from 'vue-router';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueRouter);


Vue.config.productionTip = false
Vue.use(VueSweetalert2);

import vuetify from './plugin/vuetify';
Vue.use(vuetify)

require('./global-components');

import routes from './routes'
axios.defaults.baseURL = '/api/'


Vue.component('admin-layout', require('./Main.vue').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    vuetify
});
