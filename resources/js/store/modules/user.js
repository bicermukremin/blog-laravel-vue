import Vue from "vue";
import { isLoggedIn, logOut } from "./../../shared/utils/auth";

const state = {
    users: {},
    isLoggedIn: false,
    isAdmin: false,
    user: {}
};

const getters = {
    isLoggedIn(state) {
        return state.isLoggedIn;
    },
    isAdmin(state) {
        return state.isAdmin;
    },
    getUser(state) {
        return state.user;
    }
};

const mutations = {
    setUser(state, payload) {
        state.user = payload;
    },
    setLoggedIn(state, payload) {
        state.isLoggedIn = payload;
    },
    setAdmin(state, payload) {
        state.isAdmin = payload;
    }
};

const actions = {
    async loadUser({ commit, dispatch }) {
        if (isLoggedIn()) {
            await axios.get("/user").then(res => {
                const user = res.data;
                commit("setUser", user);
                commit("setLoggedIn", true);

                if (res.data.status == 'admin') {
                    commit("setAdmin", true);
                    localStorage.setItem('isAdmin', true);
                }
            });
        } else {
            dispatch("logout");
        }
    },
    logout({ commit }) {
        commit("setUser", {});
        commit("setLoggedIn", false);
        commit("setAdmin", false);
        logOut();
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};