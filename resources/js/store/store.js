import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state: {
		numberOfProducts: 0,
		user1: {},
		user2: {},
		todaysEvents: [{}]
	},
	mutations: {
		UpdateNumberOfProducts(state, numberOfProducts) {
			state.numberOfProducts = numberOfProducts;
		},
		UpdateUser1(state, user1) {
			state.user1 = user1;
		},
		UpdateUser2(state, user2) {
			state.user2 = user2;
		},
		UpdateTodaysEvents(state, todaysEvents) {
			state.todaysEvents = todaysEvents;
		}
	},
	getters: {
		numberOfProducts: state => state.numberOfProducts,
		user1: state => state.user1,
		user2: state => state.user2,
		todaysEvents: state => state.todaysEvents
	}
})
