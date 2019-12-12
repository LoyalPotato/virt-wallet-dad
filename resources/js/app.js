/*jshint esversion: 6 */
require("./bootstrap");
import Vue from "vue";
import { store } from "./store/store";
import VueRouter from "vue-router";
import { routes } from "./routes";
import MainComponent from "./components/layouts/MainComponent.vue";
import Toasted from "vue-toasted";

const router = new VueRouter({ mode: "history", routes });

Vue.component("main-comp", MainComponent);

window.Vue = require("vue");

Vue.use(VueRouter);
Vue.use(Toasted, {
    router
});

const app = new Vue({
    router: router,
    store: store,
    el: "#app",
    components: { MainComponent },
    mounted() {
        try {
            let user = JSON.parse(sessionStorage.getItem("authed_user")) || null;
            let token = sessionStorage.getItem("access_token") || null;
            this.$store.commit("assignUser", user);
            this.$store.commit("assignToken", token);
        } catch (error) {}
    }
});
