import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    blogs: {},
    errors: {},
    meta: {},
    userBlogs: {}
};

const getters = {
    getBlogs(state) {
        return state.blogs;
    },
    getUserBlogs(state) {
        return state.userBlogs;
    },
    getBlogMeta(state) {
        return state.meta;
    },
    getBlogErrors(state) {
        return state.errors;
    },
    getBlog(state) {
        return slug =>
            state.blogs.filter(element => {
                return element.slug == slug;
            });
    }
};

const mutations = {
    addBlog(state, payload) {
        state.blogs.unshift(payload);
    },
    addUserBlog(state, payload) {
        state.userBlogs.unshift(payload);
    },
    updateBlog(state, { blogUpdate, index }) {

        Vue.set(state.blogs, index, blogUpdate);
    },
    deleteBlog(state, index) {
        Vue.delete(state.blogs, index);
    },
    deleteUserBlog(state, index) {
        Vue.delete(state.userBlogs, index);
    },

    listUserBlogs(state, payload) {
        state.userBlogs = payload;
    },
    listBlogs(state, payload) {
        state.blogs = payload;
    },
    blogMeta(state, payload) {
        state.meta = payload;
    },
    blogErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async initBlog({ commit, getters }, options) {
        const url = applyFilters("/api/blogs", options.filter);
        await axios.get(url).then(res => {

            commit("listBlogs", res.data.data);
            commit("blogMeta", res.data);
            commit("listUserBlogs", res.data.data.filter(blog => blog.author.id == getters['getUser'].id));
        });
    },
    async saveBlog({ commit, state }, payload) {

        await axios
            .post("/api/blogs", payload)
            .then(res => {
                debugger
                const blog = res.data;
                commit("deleteErrors", null);
                commit("addBlog", blog);
                commit("addUserBlog", blog);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("blogErrors", err.response.data.errors);
            });
    },
    async updateBlog({ commit, state }, payload) {
        await axios
            .post(`/api/blogs/${payload.id}`, payload.formData1, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(res => {
                const blogUpdate = res.data;
                /* debugger; */
                const index = state.blogs.findIndex(
                    blog => blog.id === blogUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateBlog", { blogUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("blogErrors", err.response.data.errors);
            });
    },
    async deleteBlog({ commit, state }, slug) {
        await axios
            .delete("/api/blogs/" + slug)
            .then(() => {
                const index1 = state.blogs.findIndex(blog => blog.slug == slug);
                commit("deleteBlog", index1);
                const index2 = state.userBlogs.findIndex(blog => blog.slug == slug);
                commit("deleteUserBlog", index2);
            })
            .catch(err => {
                commit("blogErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};