import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    comments: {},
    errors: {},
    meta: {}
};

const getters = {
    getComments(state) {
        return state.comments;
    },
    getCommentMeta(state) {
        return state.meta;
    },
    getCommentErrors(state) {
        return state.errors;
    },
    getComment(state) {
        return slug =>
            state.comments.filter(element => {
                return element.slug == slug;
            });
    }
};

const mutations = {
    addComment(state, payload) {
        state.comments.unshift(payload);
    },
    updateComment(state, { commentUpdate, index }) {
        Vue.set(state.comments, index, commentUpdate);
    },
    deleteComment(state, index) {
        Vue.delete(state.comments, index);
    },

    listComments(state, payload) {
        state.comments = payload;
    },
    commentMeta(state, payload) {
        state.meta = payload;
    },
    commentErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async initComment({ commit }, options) {
        const url = applyFilters("/api/comments", options.filter);
        await axios.get(url).then(res => {
            commit("listComments", res.data.data);
            commit("commentMeta", res.data.meta);
        });
    },
    async saveComment({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/comments", payload)
            .then(res => {
                const comment = res.data.data;
                commit("deleteErrors", null);
                commit("addComment", comment);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("commentErrors", err.response.data.errors);
            });
    },
    async updateComment({ commit, state }, payload) {
        await axios
            .patch(`/api/comments/${payload.id}`, payload)
            .then(res => {
                const commentUpdate = res.data.data;
                /* debugger; */
                const index = state.comments.findIndex(
                    comment => comment.id === commentUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateComment", { commentUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("commentErrors", err.response.data.errors);
            });
    },
    async deleteComment({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/comments/" + id)
            .then(res => {
                /* debugger; */
                const index = state.comments.findIndex(
                    comment => comment.id == id
                );
                commit("deleteComment", index);
            })
            .catch(err => {
                commit("commentErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
