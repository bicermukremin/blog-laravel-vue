require('./bootstrap');

import router from "./routes1";


import Vue from "vue";
import VueRouter from "vue-router";

import Vuex from "vuex";
import Vuelidate from "vuelidate";

import CkEditor from "ckeditor4-vue/dist/ckeditor.js";
import swal from "sweetalert2";
import VueToast from "vue-toast-notification";
import moment from "moment";
import vue2Dropzone from "vue2-dropzone";
import "vue-progress-path/dist/vue-progress-path.css";
import VueProgress from "vue-progress-path";
import VueTheMask from "vue-the-mask";
Vue.use(VueTheMask);

Vue.use(VueProgress, {
    // defaultShape: 'circle',
});

window.Swal = swal;


import { store } from "./store/store";
Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(CkEditor);
Vue.use(Vuelidate);
Vue.use(VueToast, {
    // One of the options
    position: "top",
    className: ["my-toast"],
    duration: 7000
});


Vue.use(Vuelidate);
import FatalError from "./shared/components/FatalError";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";

Vue.component("vueDropzone", vue2Dropzone);
Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Ana', require('./Ana.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
});