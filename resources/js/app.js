/*jshint esversion: 6 */
import Vue from 'vue';
import { store } from './store/store';
import VueRouter from 'vue-router';
import { routes } from './routes';
import MainComponent from './components/layouts/MainComponent.vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.component('main-comp', MainComponent);

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(ElementUI);

const app = new Vue({
	router: new VueRouter({ mode: 'history', routes }),
	store: store,
	el: '#app',
	components: { MainComponent },
	data: {
		errors: []
	}
});
