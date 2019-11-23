/*jshint esversion: 6 */
import Vue from 'vue';
import Vuex from "vuex";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: null,
        userToken: null
    },
    mutations: {
        assignUser(state, user) {
            state.user = user;
        },
        assignToken(state, token) {
            state.userToken = token;
        }
    }
});
