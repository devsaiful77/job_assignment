import { createStore } from "vuex";

/* ========================== State ========================== */
const state = {
    user: {
        data: {},
        token: localStorage.getItem("ADMIN_TOKEN"),
    },

    /* ========================== ========================== */
    image_base_link: "/../storage/",
};

/* ========================== Getters ========================== */
const getters = {};

/* ========================== Actions ========================== */
const actions = {};

/* ========================== Mutations ========================== */
const mutations = {};

/* ========================== Store ========================== */
const store = createStore({
    state: state,
    mutations: mutations,
    getters: getters,
    actions: actions,
});

export default store;
