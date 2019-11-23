/*jshint esversion: 6 */

require("./bootstrap");
window.Vue = require("vue");
import { store } from "./store/store";
import VueRouter from "vue-router";
import { routes } from "./routes";

Vue.use(VueRouter);




const router = new VueRouter({
    routes: routes,
});


const app = new Vue({
    router : router,
    store : store,
    el: "#app",
});
