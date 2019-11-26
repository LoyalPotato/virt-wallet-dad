/*jshint esversion: 6 */
import Vue from 'vue';
import Vuex from "vuex";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: null,
        token: sessionStorage.getItem('access_token') || null 
    },
    mutations: {
        assignUser(state, user) {
            state.user = user;
        },
        assignToken(state, token) {
            state.userToken = token;
        }
    },
    actions: {
        login(context, credentials){
            axios.post("/api/login",{email: credentials.email, password: credentials.password})
            .then(function(response){
            const token = response.data.access_token;
            localStorage.setItem('access_token', token);
            
            context.commit('assignToken', token);
            //TODO: Faço um endpoint na api para ir buscar qual é o user que se autenticou e atribuo aqui?
            })
            .catch(function(error){
            console.log(error);
            
            });
        },
    }
});
