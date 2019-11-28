/*jshint esversion: 6 */
import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: sessionStorage.getItem("authed_user") || null,
        token: sessionStorage.getItem("access_token") || null
    },
    mutations: {
        assignUser(state, user) {
            state.user = user;
        },
        assignToken(state, token) {
            state.token = token;
        }
    },
    actions: {
        login(context, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/login", {
                        email: credentials.email,
                        password: credentials.password
                    })
                    .then(function(response) {
                        const token = response.data.access_token;
                        localStorage.setItem("access_token", token);
                        context.commit("assignToken", token);
                        resolve(response);
                        //TODO: Faço um endpoint na api para ir buscar qual é o user que se autenticou e atribuo aqui?
                    })
                    .catch(function(error) {
                        reject(error);
                    });
            });
        },
        logout(context) {
            return new Promise((resolve, reject) => {
                axios
                    .post(
                        "/api/logout",
                        { key: "value" },
                        {
                            headers: {
                                Authorization: "Bearer " + this.state.token
                            }
                        }
                    )
                    .then(function(response) {
                        context.commit("assignToken", null);
                        localStorage.removeItem("access_token");
                        console.log("Logged out");
                        resolve(response);
                    })
                    .catch(function(error) {
                        console.log(error);
                        reject(error);
                    });
            });
        },
        getAuthUser(context) {
            // TEST: If user changes and gets stored in this
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        "/api/user/",
                        { key: "value" },
                        {
                            headers: {
                                Authorization: "Bearer " + this.state.token
                            }
                        }
                        )
                        .then(function(response) {
                            context.commit("assignUser", response.data);
                            localStorage.setItem("authed_user");
                            resolve(response);
                        })
                        .catch(function(error) {
                            reject(error);
                    });
            });
        }
    }
});
