import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
import blog from "./blog";
const state = {
    replies: {},
    errors: {},
    meta: {},
    blogReply: {},
    blogIndex: null,
    userReplies: {}
};

const getters = {
    getReplies(state) {
        return state.replies;
    },
    getUserReplies(state) {
        return state.userReplies;
    },
    getReplyMeta(state) {
        return state.meta;
    },
    getReplyErrors(state) {
        return state.errors;
    },
    getReply(state) {
        return slug =>
            state.replies.filter(element => {
                return element.slug == slug;
            });
    }
};

const mutations = {
    addReply(state, payload) {
        state.replies.unshift(payload);
    },
    updateReply(state, { replyUpdate, index }) {
        Vue.set(state.replies, index, replyUpdate);
    },

    deleteReply(state, index) {
        Vue.delete(state.replies, index);
    },

    listReplies(state, payload) {
        state.replies = payload;
    },
    replyMeta(state, payload) {
        state.meta = payload;
    },
    replyErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    },
    updateReplyBlog(state, { blogUpdate, index }) {
        state.blogReply = blogUpdate;
        state.blogIndex = index;
    },
    deleteUserReply(state, index) {
        Vue.delete(state.userReplies, index);
    },

    listUserReply(state, payload) {
        state.userReplies = payload;
    },
};

const actions = {
    async initReply({ commit, getters }, options) {
        const url = applyFilters("/api/replies", options.filter);
        await axios.get(url).then(res => {
            commit("listReplies", res.data.data);
            commit("replyMeta", res.data.meta);
        });
        let id = getters['getUser'].id;
        await axios.get(`/api/get-user-replies/${id}`).then((res) => {
            commit("listUserReply", res.data);

        })
    },
    async saveReply({ commit, state, dispatch, rootState }, payload) {
        /* debugger; */
        await axios
            .post("/api/replies", payload)
            .then(res => {
                const blogUpdate = res.data;
                /* debugger; */
                /* debugger; */
                const index = rootState.blog.blogs.findIndex(
                    blog => blog.id === blogUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateReplyBlog", { blogUpdate, index });
            })
            .then(() => {
                dispatch("initReply", { filter: null });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("replyErrors", err.res.data.errors);
            });
    },
    async saveReplyReply({ commit, state, dispatch, rootState }, payload) {
        /* debugger; */
        await axios
            .post("/api/reply-reply", payload)
            .then(res => {
                const blogUpdate = res.data;

                debugger;
                const index = rootState.blog.blogs.findIndex(
                    blog => blog.id === blogUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateReplyBlog", { blogUpdate, index });
            })
            .then(() => {
                dispatch("initReply", { filter: null });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("replyErrors", err.res.data.errors);
            });
    },
    async updateReply({ commit, state }, payload) {
        await axios
            .patch(`/api/replies/${payload.id}`, payload)
            .then(res => {
                const replyUpdate = res.data.data;
                /* debugger; */
                const index = state.replies.findIndex(
                    reply => reply.id === replyUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateReply", { replyUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("replyErrors", err.res.data.errors);
            });
    },
    async deleteReply({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/replies/" + id)
            .then(res => {
                /* debugger; */
                const index = state.replies.findIndex(reply => reply.id == id);
                commit("deleteReply", index);

                const index2 = state.userReplies.findIndex(
                    reply => reply.id == id
                );
                commit("deleteUserReply", index2);
            })
            .catch(err => {
                commit("replyErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};