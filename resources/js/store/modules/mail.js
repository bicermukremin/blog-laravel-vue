import Vue from "vue";
import { applyFilters } from "../../shared/helpers/index";
const state = {
    mails: {},
    errors: {},
    meta: {}
};

const getters = {
    getMails(state) {
        return state.mails;
    },
    getMailMeta(state) {
        return state.meta;
    },
    getMailErrors(state) {
        return state.errors;
    },
    getMail(state) {
        return key =>
            state.mails.filter(element => {
                return element.key == key;
            });
    }
};

const mutations = {
    addMail(state, payload) {
        state.mails.unshift(payload);
    },
    updateMail(state, { mailUpdate, index }) {
        Vue.set(state.mails, index, mailUpdate);
    },
    deleteMail(state, index) {
        Vue.delete(state.mails, index);
    },

    listMails(state, payload) {
        state.mails = payload;
    },
    mailMeta(state, payload) {
        state.meta = payload;
    },
    mailErrors(state, payload) {
        state.errors = payload;
    },
    deleteErrors(state, payload) {
        state.errors = payload;
    }
};

const actions = {
    async indexMail({ commit }, options) {
        const url = applyFilters("/api/mails", options.filter);

        await axios.get(url).then(res => {
            commit("listMails", res.data.data);
            commit("mailMeta", res.data.meta);
        });
    },
    async saveMail({ commit, state }, payload) {
        /* debugger; */
        await axios
            .post("/api/mails", payload)
            .then(res => {
                const mail = res.data.data;
                commit("deleteErrors", null);
                commit("addMail", mail);
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("mailErrors", err.response.data.errors);
            });
    },
    async updateMail({ commit, state }, payload) {

        await axios
            .post(`/api/mails/${payload.id}`, payload.formData1)
            .then(res => {
                const mailUpdate = res.data.data;
                /* debugger; */
                const index = state.mails.findIndex(
                    mail => mail.id === mailUpdate.id
                );
                commit("deleteErrors", null);
                commit("updateMail", { mailUpdate, index });
            })
            .catch(err => {
                commit("deleteErrors", null);
                commit("mailErrors", err.response.data.errors);
            });
    },
    async deleteMail({ commit, state }, id) {
        /* debugger; */
        await axios
            .delete("/api/mails/" + id)
            .then(res => {
                /* debugger; */
                const index = state.mails.findIndex(mail => mail.id == id);
                commit("deleteMail", index);
            })
            .catch(err => {
                commit("mailErrors", err.response.data.errors);
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};