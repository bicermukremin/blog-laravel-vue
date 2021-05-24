import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    sliders: {},
    errors: {},
    meta: {}
};

const getters = {
    getSliders(state) {
        return state.sliders;
    },
    getSliderMeta(state) {
        return state.meta;
    },
    getSliderErrors(state) {
        return state.errors;
    },
    getSlider(state) {
        return key =>
            state.sliders.filter(element => {
                return element.key == key;
            });
    }
};

const mutations = {
    addSlider(state, payload) {
        state.sliders.unshift(payload);
    },
    updateSlider(state, { sliderUpdate, index }) {
        Vue.set(state.sliders, index, sliderUpdate);
    },
    deleteSlider(state, index) {
        Vue.delete(state.sliders, index);
    },

    listSliders(state, payload) {
        state.sliders = payload;
    },
    sliderMeta(state, payload) {
        state.meta = payload;
    },
    sliderErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async initSlider({ commit }, options) {
        const url = applyFilters("/api/sliders", options.filter);
        await axios.get(url).then(res => {
            commit("listSliders", res.data.data);
            commit("sliderMeta", res.data.meta);
        });
    },
    async saveSlider({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/sliders", payload)
            .then(res => {
                const slider = res.data.data;
                commit("deleteErrors", null);
                commit("addSlider", slider);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("sliderErrors", err.response.data.errors);
            });
    },
    async updateSlider({ commit, state }, payload) {
        await axios
            .post(`/api/sliders/${payload.id}`, payload.formData1, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(res => {
                const sliderUpdate = res.data;
                /* debugger; */
                const index = state.sliders.findIndex(
                    slider => slider.id === sliderUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateSlider", { sliderUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("sliderErrors", err.response.data.errors);
            });
    },
    async deleteSlider({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/sliders/" + id)
            .then(res => {
                /* debugger; */
                const index = state.sliders.findIndex(
                    slider => slider.id == id
                );
                commit("deleteSlider", index);
            })
            .catch(err => {
                commit("sliderErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};