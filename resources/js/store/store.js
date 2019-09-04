import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state: {
		numberOfProducts: 0
	},
	mutations: {
		UpdateNumberOfProducts(state, numberOfProducts) {
			state.numberOfProducts = numberOfProducts;
		}
	},
	getters: {
		numberOfProducts: state => state.numberOfProducts
	}
})
