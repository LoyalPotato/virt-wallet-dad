/*jshint esversion: 6 */
import Vue from "vue";
import LoginComponent from "./components/auth/LoginComponent.vue";
const loginComp = Vue.component("login", LoginComponent);
import RegisterComponent from "./components/auth/RegisterComponent.vue";
const registerComp = Vue.component("register", RegisterComponent); //NOTE: Precisamos desta variavel para que?
import HomePage from "./components/HomePageComponent.vue";
const homePage = Vue.component("home", HomePage);
import StartPage from "./components/StartPageComponent.vue";
const startPage = Vue.component("start-page", StartPage);
import RegisterIncome from "./components/RegisterIncomeComponent.vue";
const rInc = Vue.component("r-inc", RegisterIncome);
   
export const routes = [
    { path: "/", name: "start", component: startPage},
    { path: "/home", name: "home", component: homePage},
    { path: "/login", name: "login", component: loginComp },
    { path: "/register", name: "register",  component: registerComp }
];