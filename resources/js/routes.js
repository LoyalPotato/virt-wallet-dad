/*jshint esversion: 6 */
import Vue from "vue";
import LoginComponent from "./components/auth/LoginComponent.vue";
const loginComp = Vue.component("login", LoginComponent);
import RegisterComponent from "./components/auth/RegisterComponent.vue";
const registerComp = Vue.component("register", RegisterComponent); //NOTE: Precisamos desta variavel para que?
import HomePage from "./components/HomePagecomponent.vue";
const homePage = Vue.component("home", HomePage);


export const routes = [
    // { path: "/", name: "home", component: homePage},
    { path: "/login", name: "login", component: loginComp },
    { path: "/register", name: "register",  component: registerComp }
];