import Vue from "vue";
import VueRouter from "vue-router";

import Ana from "./Ana.vue";
import FrontendHome from "./Frontend/Frontend.vue";
import Hizmet from "./Frontend/pages/Hizmetlerimiz.vue";
import Hakkimizda from "./Frontend/pages/Hakkimizda.vue";
import Projelerimiz from "./Frontend/pages/Projelerimiz.vue";
import BizeUlasin from "./Frontend/pages/BizeUlasin.vue";
/* import Profile from "./Frontend/pages/Profile.vue"; */
import Haber from "./Frontend/pages/Haber.vue";
import SingleBlog from "./Frontend/pages/SingleBlog.vue";
import SingleService from "./Frontend/pages/SingleService.vue";
import Auth from "./Frontend/pages/Auth.vue";



import AdminHome from "./Admin/Admin.vue";
import Login from "./Admin/pages/Login.vue";
import Register from "./Admin/pages/Register.vue";
import Service from "./Admin/pages/Service.vue";
import Ayar from "./Admin/pages/Settings.vue";
import Slider from "./Admin/pages/Slider.vue";
import About from "./Admin/pages/About.vue";
import AboutEdit from "./Admin/pages/AboutEdit.vue";
/* import Blog from "./Admin/pages/Blog.vue"; */
import Project from "./Admin/pages/Project.vue";
import Category from "./Admin/pages/Category.vue";
/* import Comment from "./Admin/pages/Comment.vue"; */
/* import Reply from "./Admin/pages/Reply.vue"; */
import Banner from "./Admin/pages/Banner.vue";
import Abone from "./Admin/pages/Abone.vue";
import Mail from "./Admin/pages/Mail.vue";
import { isLoggedIn } from "./shared/utils/auth";





const routes = [{
        path: "",
        component: FrontendHome,
        name: "frontend"
    },

    /* {
        path: "/madmin",
        component: AdminHome,
        name: "admin"
    }, */
    /*  {
         path: "/haberler",
         component: Haber,
         name: "haber"
     }, */
    {
        path: "/hizmetlerimiz",
        component: Hizmet,
        name: "hizmet"
    },
    {
        path: "/hakkimizda",
        component: Hakkimizda,
        name: "hakkimizda"
    },
    {
        path: "/projelerimiz",
        component: Projelerimiz,
        name: "projelerimiz"
    },
    {
        path: "/bizeulasin",
        component: BizeUlasin,
        name: "bizeulasin"
    },
    /* {
        path: ":user",
        component: Profile,
        name: "profile"
    }, */
    /* {
        path: ":slug",
        component: SingleBlog,
        name: "singleBlog"
    }, */
    {
        path: ":slugService",
        component: SingleService,
        name: "singleService"
    },
    {
        path: "/madmin",
        component: AdminHome,
        name: "admin",
        meta: { admin: true },
        children: [{
                path: "hizmetler",
                component: Service,
                name: "services",
                meta: { admin: true }
            },
            {
                path: "ayarlar",
                component: Ayar,
                name: "ayarlar",
                meta: { admin: true }
            },
            {
                path: "slaytlar",
                component: Slider,
                name: "slider",
                meta: { admin: true }
            },
            {
                path: "hakkimizda",
                component: About,
                name: "about",
                meta: { admin: true }
            },
            {
                path: "hakkimizda/düzenle",
                component: AboutEdit,
                name: "aboutEdit",
                meta: { admin: true }
            },
            /* {
                path: "blog",
                component: Blog,
                name: "blog",
                meta: { admin: true }
            },
            {
                path: "project",
                component: Project,
                name: "project",
                meta: { admin: true }
            }, */
            {
                path: "kategoriler",
                component: Category,
                name: "category",
                meta: { admin: true }
            },
            /* {
                path: "yorumlar",
                component: Comment,
                name: "comment",
                meta: { admin: true }
            }, */
            /* {
                path: "cevaplar",
                component: Reply,
                name: "reply",
                meta: { admin: true }
            }, */
            {
                path: "bannerlar",
                component: Banner,
                name: "banner",
                meta: { admin: true }
            },
            {
                path: "aboneler",
                component: Abone,
                name: "abone",
                meta: { admin: true }
            },
            {
                path: "mailler",
                component: Mail,
                name: "mail",
                meta: { admin: true }
            },
            {
                path: "*",
                redirect: { name: "admin" }
            }
        ]
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