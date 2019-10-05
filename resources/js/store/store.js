import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state: {
		numberOfGroceryProducts: 0,
		numberOfClothesProducts: 0,
		numberOfOtherProducts: 0,
		user1: {},
		user2: {},
		todaysEvents: [{}],
	},
	mutations: {
		UpdateNumberOfGroceryProducts(state, numberOfGroceryProducts) {
			state.numberOfGroceryProducts = numberOfGroceryProducts;
		},
		UpdateNumberOfClothesProducts(state, numberOfClothesProducts) {
			state.numberOfClothesProducts = numberOfClothesProducts;
		},
		UpdateNumberOfOtherProducts(state, numberOfOtherProducts) {
			state.numberOfOtherProducts = numberOfOtherProducts;
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
		numberOfGroceryProducts: state => state.numberOfGroceryProducts,
		numberOfClothesProducts: state => state.numberOfClothesProducts,
		numberOfOtherProducts: state => state.numberOfOtherProducts,
		user1: state => state.user1,
		user2: state => state.user2,
		todaysEvents: state => state.todaysEvents
	}
})
