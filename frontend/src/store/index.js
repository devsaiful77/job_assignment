import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
  state: {
    user: {
      data: {},
      token: sessionStorage.getItem("TOKEN"),
    },
  },
  getters: {},
  actions: {
    login({ commit }, user) {
      return axiosClient
        .post("/login", user)
        .then(({ data }) => {
          commit("setUser", data.user);
          commit("setToken", data.token);
          return data;
        })
        .catch((err) => {
          // Handle validation errors here
          if (err.response && err.response.data) {
            // Check for validation errors
            return Promise.reject(
              err.response.data.errors || "Login failed. Please try again."
            );
          }
          // If no validation error, fallback to a general error
          return Promise.reject("Invalid Credentials.");
        });
    },

    logout({ commit }) {
      return axiosClient.post("/logout").then((response) => {
        commit("logout");
        return response;
      });
    },
    getUser({ commit }) {
      return axiosClient.get("/user").then((res) => {
        console.log(res);
        commit("setUser", res.data);
      });
    },
  },
  mutations: {
    logout: (state) => {
      state.user.token = null;
      state.user.data = {};
      sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
      state.user.data = user;
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem("TOKEN", token);
    },
  },
  modules: {},
});

export default store;
