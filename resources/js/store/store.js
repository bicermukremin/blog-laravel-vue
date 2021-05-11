import Vue from "vue";
import Vuex from "vuex";
import service from "./modules/service";
import user from "./modules/user";
import slider from "./modules/slider";
import about from "./modules/about";
import blog from "./modules/blog";
import project from "./modules/project";
import category from "./modules/category";
import comment from "./modules/comment";
import reply from "./modules/reply";
import software from "./modules/software";
import setting from "./modules/setting";
import banner from "./modules/banner";
import abone from "./modules/abone";
import mail from "./modules/mail";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    getters,
    mutations,
    actions,
    modules: {
        service,
        user,
        slider,
        about,
        blog,
        project,
        category,
        comment,
        reply,
        software,
        setting,
        banner,
        abone,
        mail
    }
});
