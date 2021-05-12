require("./bootstrap");

import router from "./routes.js";

import Vue from "vue";
import VueRouter from "vue-router";


import Vuex from "vuex";
import Vuelidate from "vuelidate";

import CkEditor from "ckeditor4-vue/dist/ckeditor.js";
import swal from "sweetalert2";
import VueToast from "vue-toast-notification";
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



import Ana from './Ana.vue'
import FatalError from "./shared/components/FatalError";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";

Vue.component("vueDropzone", vue2Dropzone);
Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);
window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status) {
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);
/* Vue.filter("fromNow", value => moment(value).fromNow());
Vue.filter("day", value => value.substring(0, 2));
Vue.filter("month", value => value.substring(3, 3)); */

const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        Ana
    },
    async created() {
        this.$store.dispatch("loadUser");


        /*  this.$store.dispatch("initBlog", { filter: this.filter }); */
    }
});