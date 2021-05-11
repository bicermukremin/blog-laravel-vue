import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    categories: {},
    errors: {},
    meta: {}
};

const getters = {
    getCategories(state) {
        return state.categories;
    },
    getCategoryMeta(state) {
        return state.meta;
    },
    getCategoryErrors(state) {
        return state.errors;
    },
    getCategory(state) {
        return name =>
            state.categories.filter(element => {
                return element.name == name;
            });
    }
};

const mutations = {
    addCategory(state, payload) {
        state.categories.unshift(payload);
    },
    updateCategory(state, { categoryUpdate, index }) {
        Vue.set(state.categories, index, categoryUpdate);
    },
    deleteCategory(state, index) {
        Vue.delete(state.categories, index);
    },

    listCategories(state, payload) {
        state.categories = payload;
    },
    categoryMeta(state, payload) {
        state.meta = payload;
    },
    categoryErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async initCategory({ commit }, options) {
        const url = applyFilters("/api/categories", options.filter);
        await axios.get(url).then(res => {
            commit("listCategories", res.data.data);
            commit("categoryMeta", res.data.meta);
        });
    },
    async saveCategory({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/categories", payload)
            .then(res => {
                const category = res.data.data;
                commit("deleteErrors", null);
                commit("addCategory", category);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("categoryErrors", err.response.data.errors);
            });
    },
    async updateCategory({ commit, state }, payload) {
        /* debugger; */
        await axios
            .patch(`/api/categories/${payload.id}`, payload)
            .then(res => {
                const categoryUpdate = res.data.data;
                /* debugger; */
                const index = state.categories.findIndex(
                    category => category.id === categoryUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateCategory", { categoryUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("categoryErrors", err.response.data.errors);
            });
    },
    async deleteCategory({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/categories/" + id)
            .then(res => {
                /* debugger; */
                const index = state.categories.findIndex(
                    category => category.id == id
                );
                commit("deleteCategory", index);
            })
            .catch(err => {
                commit("categoryErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
