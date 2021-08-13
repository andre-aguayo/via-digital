/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import validationlogin from './components/ValidationLogin.vue';

import { createApp } from 'vue';

let Vue = createApp({})

Vue.component('validation-login', require('./components/ValidationLogin.vue').default);

Vue.mount("#app");
