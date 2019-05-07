<template>
<div>
    <v-layout row>
        <v-flex xs12 sm6 offset-sm3>
            <v-card>
                <v-toolbar color="purple" dark>
                    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-toolbar-side-icon
          v-on="on"
        >
          <v-icon>menu</v-icon>
      </v-toolbar-side-icon>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in menuItems"
          :key="index"
          @click="clearList(shoppingList)"
        >
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
                    <v-toolbar-title class="text-xs-center">Shopping list</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon color="purple">
                        <v-icon>search</v-icon>
                    </v-btn>

                </v-toolbar>
                <transition-group name="card">
                        <Product ref="product1" @updateShoppingList="getShoppingList" v-for="product in shoppingList" :product="product" :key="product.id">
                        </Product>
                </transition-group>

                <v-form>
                    <v-container>
                        <v-layout row>
                            <v-combobox v-model="product.name" :items="products" label="Name" item-text="name" :return-object="false"></v-combobox>
                            <v-text-field label="Amount" v-model="product.quantity"></v-text-field>
                            <v-btn color="cyan" @click="addProductToShoppingList(product)" dark>Add</v-btn>
                        </v-layout>
                    </v-container>
                </v-form>
            </v-card>
        </v-flex>
    </v-layout>
</div>
</template>

<script>
import Product from "./Product.vue";
import Alert from './Alert.vue';
import axios from 'axios';

export default {
    name: "ShoppingList",
    data() {
        return {
            shoppingList: [],
            products: [],
            product: {},
            menuItems: [
            { title: 'Clear list' }
      ]
        };
    },
    components: {
        Product,
        Alert
    },
    mounted() {
        this.getShoppingList();
        this.getAllProducts();
    },
    methods: {

        changeAlertState() {
            this.$refs.alert.showTheAlert();
        },

        clearList(shoppingList){
            axios.put('api/shopping-list/clear-list', shoppingList)
                .then(response => {
                    this.getShoppingList();
                })
                .catch(function(error) {
                })
                .then(function() {
                });
        },

        getShoppingList() {
            axios.get('api/shopping-list/uncompleted')
                .then(response => {
                    this.shoppingList = response.data;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        },

        getAllProducts() {
            axios.get('api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        },

        addProductToShoppingList(product) {
            axios.post('api/product/create', product)
                .then(response => {
                    this.getShoppingList();
                })
                .catch(function(error) {
                    console.log("heeej");
                    console.log(error);
                })
                .then(function() {
                    product.quantity = ''
                    product.name = ''
                });
        },
    }

};
</script>

<style>


 .card-enter-active{
  position: absolute;
}

.card-leave-active{
    position: absolute;
    display: none;
    right: 0;
}

.card-move {
  transition: all .5s;
}

</style>
