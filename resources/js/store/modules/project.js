import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    projects: {},
    errors: {},
    meta: {}
};

const getters = {
    getProjects(state) {
        return state.projects;
    },
    getProjectMeta(state) {
        return state.meta;
    },
    getProjectErrors(state) {
        return state.errors;
    },
    getProject(state) {
        return key =>
            state.projects.filter(element => {
                return element.key == key;
            });
    }
};

const mutations = {
    addProject(state, payload) {
        state.projects.unshift(payload);
    },
    updateProject(state, { projectUpdate, index }) {
        Vue.set(state.projects, index, projectUpdate);
    },
    deleteProject(state, index) {
        Vue.delete(state.projects, index);
    },

    listProjects(state, payload) {
        state.projects = payload;
    },
    projectMeta(state, payload) {
        state.meta = payload;
    },
    projectErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async initProject({ commit }, options) {
        const url = applyFilters("/api/projects", options.filter);
        await axios.get(url).then(res => {
            commit("listProjects", res.data.data);
            commit("projectMeta", res.data.meta);
        });
    },
    async getServiceProject({ commit }, options) {
        const url = applyFilters("/api/projects", options.filter);
        await axios.get(url).then(res => {
            commit("listProjects", res.data.data[0].projects);
        });
    },
    async saveProject({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/projects", payload)
            .then(res => {
                const project = res.data.data;
                commit("deleteErrors", null);
                commit("addProject", project);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("projectErrors", err.response.data.errors);
            });
    },
    async updateProject({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post(`/api/projects/${payload.id}`, payload.formData1, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(res => {
                const projectUpdate = res.data.data;
                /* debugger; */
                const index = state.projects.findIndex(
                    project => project.id === projectUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateProject", { projectUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("projectErrors", err.response.data.errors);
            });
    },
    async deleteProject({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/projects/" + id)
            .then(res => {
                /* debugger; */
                const index = state.projects.findIndex(
                    project => project.id == id
                );
                commit("deleteProject", index);
            })
            .catch(err => {
                commit("projectErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
