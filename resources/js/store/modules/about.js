import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    about: {},
    abouts: {},
    errors: {},
    meta: {},
    frontendAbout: {}
};

const getters = {
    getBaseAbout(state) {
        return state.about;
    },
    getFrontend(state) {
        return state.frontendAbout;
    },
    getFrontendImages(state) {
        return state.frontendAbout.images;
    },
    getFrontendHistory(state) {
        return state.frontendAbout.history_items;
    },
    getAbouts(state) {
        return state.abouts;
    },
    getAboutErrors(state) {
        return state.errors;
    },
    getAboutMeta(state) {
        return state.meta;
    }
};

const mutations = {
    addAbout(state, payload) {
        state.about = payload;
    },

    updateAbout1(state, { aboutRes1, index1 }) {
        Vue.set(state.abouts, index1, aboutRes1);
        /* state.abouts.splice(index, 1, about); */
    },
    updateAbout2(state, { aboutRes2, index2 }) {
        Vue.set(state.abouts, index2, aboutRes2);
        /* state.abouts.splice(index, 1, about); */
    },
    updateAbout(state, { aboutUpdate, index }) {
        Vue.set(state.abouts, index, aboutUpdate);
        /* state.abouts.splice(index, 1, about); */
    },

    deleteAbout(state, index) {
        Vue.delete(state.abouts, index);
    },

    indexAbout(state, payload) {
        state.abouts = payload;
    },
    frontendAbout(state, payload) {
        state.frontendAbout = payload;
    },

    aboutErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    },
    aboutMeta(state, payload) {
        state.meta = payload;
    }
};

const actions = {
    async indexAbout({ commit }, options) {
        const url = applyFilters("/api/about", options.filter);
        await axios.get(url).then(res => {
            commit("indexAbout", res.data.data);
            commit(
                "addAbout",
                res.data.data.find(a => a.active == 1)
            );
            commit("aboutMeta", res.data.meta);
        });
    },
    async storeAbout({ commit, state }, payload) {
        await axios
            .post("/api/about", payload)
            .then(res => {
                const about = res.data.data;
                commit("deleteErrors", null);
                commit("addAbout", about);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("aboutErrors", err.response.data.errors);
            });
    },
    async makeActive({ commit }, id) {
        await axios
            .post(`/api/makeActive/${id}`)
            .then(res => {
                if (res.data.data[1]) {
                    const aboutRes1 = res.data.data[0];
                    const aboutRes2 = res.data.data[1];
                    const index1 = state.abouts.findIndex(
                        about => about.id === aboutRes1.id
                    );
                    const index2 = state.abouts.findIndex(
                        about => about.id === aboutRes2.id
                    );
                    /* debugger; */
                    commit("deleteErrors", null);
                    commit("updateAbout1", { aboutRes1, index1 });
                    commit("updateAbout2", { aboutRes2, index2 });
                } else {
                    const aboutRes1 = res.data.data;
                    const index1 = state.abouts.findIndex(
                        about => about.id === aboutRes1.id
                    );
                    commit("deleteErrors", null);
                    commit("updateAbout1", { aboutRes1, index1 });
                }
            })
            .catch(err => {
                commit("deleteErrors", null);
                /* commit("aboutErrors", err.response.data.errors); */
            });
    },
    async getFrontendAbout({ commit }) {
        await axios
            .get(`/api/front-about`)
            .then(res => {
                const about = res.data.data;

                commit("deleteErrors", null);
                commit("frontendAbout", about);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("aboutErrors", err.response.data.errors);
            });
    },
    async updateAbout({ commit, state }, payload) {
        await axios
            .post(`/api/about`, payload)
            .then(res => {
                const aboutUpdate = res.data.data;
                /* debugger; */
                const index = state.abouts.findIndex(
                    about => about.id === aboutUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateAbout", { aboutUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("aboutErrors", err.response.data.errors);
            });
    },
    async deleteAbout({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/about/" + id)
            .then(res => {
                /* debugger; */
                const index = state.abouts.findIndex(about => about.id === id);
                commit("deleteAbout", index);
            })
            .catch(err => {
                commit("aboutErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
