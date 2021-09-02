/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

let Vue = createApp({});

//formulario de login
Vue.component('form-login', require('./components/user-components/form-login.vue').default);

//formulario de cadastro do usuario
Vue.component('form-register', require('./components/user-components/form-register.vue').default);

//script de dashboard
Vue.component('form-workboard', require('./components/dashboard/index.vue').default);

Vue.mount("#app");