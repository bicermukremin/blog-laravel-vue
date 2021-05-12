import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    abones: {},
    errors: {},
    meta: {}
};

const getters = {
    getAbones(state) {
        return state.abones;
    },
    getAboneMeta(state) {
        return state.meta;
    },
    getAboneErrors(state) {
        return state.errors;
    },
    getAbone(state) {
        return key =>
            state.abones.filter(element => {
                return element.key == key;
            });
    }
};

const mutations = {
    addAbone(state, payload) {
        state.abones.unshift(payload);
    },
    updateAbone(state, { aboneUpdate, index }) {
        Vue.set(state.abones, index, aboneUpdate);
    },
    deleteAbone(state, index) {
        Vue.delete(state.abones, index);
    },

    listAbones(state, payload) {
        state.abones = payload;
    },
    aboneMeta(state, payload) {
        state.meta = payload;
    },
    aboneErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async indexAbone({ commit }, options) {
        const url = applyFilters("/api/abones", options.filter);

        await axios.get(url).then(res => {
            commit("listAbones", res.data.data);
            commit("aboneMeta", res.data.meta);
        });
    },
    async saveAbone({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/abones", payload)
            .then(res => {
                const abone = res.data.data;
                commit("deleteErrors", null);
                commit("addAbone", abone);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("aboneErrors", err.response.data.errors);
            });
    },
    async updateAbone({ commit, state }, payload) {

        await axios
            .post(`/api/abones/${payload.id}`, payload.formData1)
            .then(res => {
                const aboneUpdate = res.data.data;
                /* debugger; */
                const index = state.abones.findIndex(
                    abone => abone.id === aboneUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateAbone", { aboneUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("aboneErrors", err.response.data.errors);
            });
    },
    async deleteAbone({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/abones/" + id)
            .then(res => {
                /* debugger; */
                const index = state.abones.findIndex(abone => abone.id == id);
                commit("deleteAbone", index);
            })
            .catch(err => {
                commit("aboneErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};