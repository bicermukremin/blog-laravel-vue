import Vue from "vue";
import { applyFilters } from "./../../shared/helpers/index";
const state = {
    services: {},
    service: {},
    errors: {},
    meta: {}
};

const getters = {
    getServices(state) {
        return state.services;
    },
    getServiceMeta(state) {
        return state.meta;
    },
    getServiceErrors(state) {
        return state.errors;
    },
    getService(state) {
        return id =>
            state.services.filter(element => {
                return element.id == id;
            });
    }
};

const mutations = {
    addService(state, payload) {
        state.services.unshift(payload);
    },
    updateService(state, { serviceUpdate, index }) {
        Vue.set(state.services, index, serviceUpdate);
    },
    deleteService(state, index) {
        Vue.delete(state.services, index);
    },

    listServices(state, payload) {
        state.services = payload;
    },
    setService(state, payload) {
        state.service = payload;
    },
    serviceMeta(state, payload) {
        state.meta = payload;
    },
    serviceErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async initService({ commit }, options) {
        const url = applyFilters("/api/services", options.filter);
        await axios.get(url).then(res => {
            commit("listServices", res.data.data);
            commit("serviceMeta", res.data.meta);
        });
    },
    async getServiceFromServer({ commit }, options) {
        const url = applyFilters("/api/services", options.filter);
        await axios.get(url).then(res => {
            commit("listServices", res.data.data);
        });
    },
    getService({ commit }, options) {
        commit("setService", options);
    },

    async saveService({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/services", payload)
            .then(res => {
                const service = res.data.data;
                commit("deleteErrors", null);
                commit("addService", service);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("serviceErrors", err.response.data.errors);
            });
    },
    async updateService({ commit, state }, payload) {
        await axios
            .post(`/api/services/${payload.id}`, payload.formData1, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(res => {
                const serviceUpdate = res.data.data;
                /* debugger; */
                const index = state.services.findIndex(
                    service => service.id === serviceUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateService", { serviceUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("serviceErrors", err.response.data.errors);
            });
    },
    async deleteService({ commit, state }, slug) {
        /* debugger; */
        await axios
            .delete("/api/services/" + slug)
            .then(res => {
                /* debugger; */
                const index = state.services.findIndex(
                    service => service.slug == slug
                );
                commit("deleteService", index);
            })
            .catch(err => {
                commit("serviceErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
