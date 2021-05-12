const state = {
    setting: {},
    errors: {}
};

const getters = {
    getSetting(state) {
        return state.setting;
    },
    getSettingMeta(state) {
        return state.meta;
    },
    getSettingErrors(state) {
        return state.errors;
    }
};

const mutations = {
    updateSetting(state, payload) {
        state.setting = payload;
    },

    settingErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async indexSetting({ commit }) {
        debugger
        await axios.get("/api/settings").then(res => {
            commit("updateSetting", res.data.data);
        });
    },

    async updateSetting({ commit, state }, payload) {
        await axios
            .post(`/api/settings`, payload, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(res => {
                const settingUpdate = res.data.data;
                /* debugger; */

                commit("deleteErrors", null);
                commit("updateSetting", settingUpdate);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("settingErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};