import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast, {
    // One of the options
    position: "bottom-right",
    color: "#fff"
});

export const is404 = function(err) {
    return isErrorWithResponseAndStatus(err) && 404 === err.response.status;
};

export const is422 = function(err) {
    return isErrorWithResponseAndStatus(err) && 422 === err.response.status;
};

const isErrorWithResponseAndStatus = function(err) {
    return err.response && err.response.status;
};
export const inputError = function(errors = []) {
    for (let index = 0; index < errors.length; index++) {
        for (let key = 0; key < errors[index].length; key++) {
            Vue.$toast.error(errors[index][key]);
        }
        /*  console.log("Ana Error" + errors[index]);
        Vue.$toast.warning(errors[index][0]); */
    }
};
