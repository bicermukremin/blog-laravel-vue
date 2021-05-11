import Vue from "vue";
import VueRouter from "vue-router";

import Ana from "./Ana.vue";
import FrontendHome from "./Frontend/Frontend.vue";
import AdminHome from "./Admin/Admin.vue";





const routes = [{
        path: "",
        component: FrontendHome,
        name: "frontend"
    },
    {
        path: "/madmin",
        component: AdminHome,
        name: "admin"
    },

    {
        path: "*",
        redirect: { name: "frontend" }
    }


];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});



export default router;