/*jshint esversion: 6 */
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
	state: {
		user: sessionStorage.getItem('authed_user') || null,
		token: sessionStorage.getItem('access_token') || null
	},
	mutations: {
		assignUser(state, user) {
			state.user = user;
		},
		assignToken(state, token) {
			state.token = token;
		},
		setMsg(state, msg) {
			state.resMsg = msg;
		}
	},
	actions: {
		login(context, credentials) {
			return new Promise((resolve, reject) => {
				axios
					.post('/api/login', {
						email: credentials.email,
						password: credentials.password
					})
					.then(function(response) {
						localStorage.setItem('access_token', response.data.access_token);
						context.commit('assignToken', response.data.access_token);
						resolve(response);
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
						'/api/logout',
						{ key: 'value' },
						{
							headers: {
								Authorization: 'Bearer ' + this.state.token
							}
						}
					)
					.then(function(response) {
						context.commit('assignToken', null);
						localStorage.removeItem('access_token');
						context.commit('assignUser', null);
						localStorage.removeItem('authed_user');
						console.log('Logged out'); //DEV_ONLY
						resolve(response);
					})
					.catch(function(error) {
						console.log(error); //DEV_ONLY
						reject(error);
					});
			});
		},
		getAuthUser(context) {
			return new Promise((resolve, reject) => {
				axios
					.get('/api/user/', {
						headers: {
							Authorization: 'Bearer ' + this.state.token
						}
					})
					.then(function(response) {
						context.commit('assignUser', response.data);
						localStorage.setItem('authed_user', response.data);
						resolve(response);
					})
					.catch(function(error) {
						reject(error);
					});
			});
		},
		registerUser(data) {
			return new Promise((resolve, reject) => {
				axios
					.post('/api/register/', {
						name: data.name,
						email: data.email,
						password: data.password,
						password_confirmation: data.password_confirmation,
						photo: data.photo,
						nif: data.nif
					})
					.then(function(response) {
						/* localStorage.setItem('access_token', response.data.access_token);
						context.commit('assignToken', response.data.access_token); */
						resolve(response);
					})
					.catch(function(error) {
						reject(error);
					});
			});
		}
	}
});
