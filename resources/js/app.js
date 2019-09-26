require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import axios from 'axios';
Vue.use(axios);

import { Form, HasError, AlertError } from 'vform';
window.Form = Form;

import swal from 'sweetalert2';
window.swal = swal;

const Toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000
});

import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css';
Vue.use(VueGoodTablePlugin);

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


Vue.component('people', require('./components/People.vue').default);

let routes = [
    { name:'People',
      path: '/home', 
      component: require('./components/People.vue').default },

    { 
      name:'User',
      path: '/user', 
      component: require('./components/User.vue').default },
  ]

const router = new VueRouter({
    mode:'history',
    routes 
  })
const app = new Vue({
    el: '#app',
    router
});
