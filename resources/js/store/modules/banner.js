import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    banners: {},
    errors: {},
    meta: {}
};

const getters = {
    getBanners(state) {
        return state.banners;
    },
    getBannerMeta(state) {
        return state.meta;
    },
    getBannerErrors(state) {
        return state.errors;
    },
    getBanner(state) {
        return key =>
            state.banners.filter(element => {
                return element.key == key;
            });
    }
};

const mutations = {
    addBanner(state, payload) {
        state.banners.unshift(payload);
    },
    updateBanner(state, { bannerUpdate, index }) {
        Vue.set(state.banners, index, bannerUpdate);
    },
    deleteBanner(state, index) {
        Vue.delete(state.banners, index);
    },

    listBanners(state, payload) {
        state.banners = payload;
    },
    bannerMeta(state, payload) {
        state.meta = payload;
    },
    bannerErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async indexBanner({ commit }, options) {
        const url = applyFilters("/api/banners", options.filter);
        await axios.get(url).then(res => {
            commit("listBanners", res.data.data);
            commit("bannerMeta", res.data.meta);
        });
    },
    async saveBanner({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/banners", payload)
            .then(res => {
                const banner = res.data.data;
                commit("deleteErrors", null);
                commit("addBanner", banner);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("bannerErrors", err.response.data.errors);
            });
    },
    async updateBanner({ commit, state }, payload) {
        await axios
            .post(`/api/banners/${payload.id}`, payload.formData1, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(res => {
                const bannerUpdate = res.data.data;
                /* debugger; */
                const index = state.banners.findIndex(
                    banner => banner.id === bannerUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateBanner", { bannerUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("bannerErrors", err.response.data.errors);
            });
    },
    async deleteBanner({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/banners/" + id)
            .then(res => {
                /* debugger; */
                const index = state.banners.findIndex(
                    banner => banner.id == id
                );
                commit("deleteBanner", index);
            })
            .catch(err => {
                commit("bannerErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};