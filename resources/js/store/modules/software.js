import Vue from "vue";

const state = {
    software: {},
    frontSoftware: {},
    errors: {}
};

const getters = {
    getBaseSoftware(state) {
        return state.software;
    },
    getFrontendSoftware(state) {
        return state.frontSoftware.images;
    },
    getSoftwareImages(state) {
        return JSON.parse(state.software[0]);
    },
    getSoftwares(state) {
        return state.softwares;
    },
    getSoftwareErrors(state) {
        return state.errors;
    }
};

const mutations = {
    addSoftware(state, payload) {
        state.software = payload;
    },
    updateSoftware(state, softwareUpdate) {
        state.software = softwareUpdate;
    },
    updateFrontendSoftware(state, payload) {
        state.frontSoftware = payload;
    },
    deleteSoftware(state, index) {
        Vue.delete(state.softwares, index);
    },

    listSoftware(state, payload) {
        state.software = payload;
    },

    softwareErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async indexSoftware({ commit }) {
        await axios.get("/api/yazilim").then(res => {
            /* debugger; */
            commit("listSoftware", res.data.data);
        });
    },
    async storeSoftware({ commit, state }, payload) {
        await axios
            .post("/api/yazilim", payload)
            .then(res => {
                const software = res.data.data;
                commit("deleteErrors", null);
                commit("addSoftware", software);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("softwareErrors", err.response.data.errors);
            });
    },

    async getSoftware({ commit }, payload) {
        await axios
            .get(`/api/yazilim/${payload}`)
            .then(res => {
                const software = res.data.data;
                /* debugger; */
                commit("deleteErrors", null);
                commit("updateSoftware", software);
            })
            .catch(err => {
                commit("deleteErrors", null);
            });
    },
    async getFrontSoftware({ commit }) {
        await axios
            .get(`/api/front-software`)
            .then(res => {
                const software = res.data.data;
                /* debugger; */
                commit("deleteErrors", null);
                commit("updateFrontendSoftware", software);
            })
            .catch(err => {
                commit("deleteErrors", null);
            });
    },
    async updateSoftware({ commit, state }, payload) {
        await axios
            .patch(`/api/yazilim/${payload.id}`, payload)
            .then(res => {
                const softwareUpdate = res.data.data;
                /* debugger; */
                commit("deleteErrors", null);
                commit("updateSoftware", softwareUpdate);
            })
            .catch(err => {
                commit("deleteErrors", null);
            });
    },
    async deleteSoftware({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/yazilim/" + id)
            .then(res => {
                /* debugger; */
                const index = state.softwares.findIndex(
                    software => software.id === id
                );
                commit("deleteSoftware", index);
            })
            .catch(err => {
                commit("softwareErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
