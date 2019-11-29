import Vue from 'vue';
import { store } from "./store/store";
import VueRouter from "vue-router";
import { routes } from "./routes";
import MainComponent from './components/layouts/MainComponent.vue';

Vue.component("main-comp", MainComponent);

window.Vue = require("vue");
Vue.use(VueRouter);

const app = new Vue({
    router: new VueRouter({mode: 'history', routes}),
    store : store,
    el: "#app",
    components: {
        MainComponent
    }
});


