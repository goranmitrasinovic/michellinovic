<template>
<div>
    {{product}}
    <v-layout row>
        <v-flex xs12 sm6 offset-sm3>
            <v-card>
                <v-toolbar color="purple" dark>
                    <v-toolbar-side-icon color="purple"></v-toolbar-side-icon>
                    <v-toolbar-title class="text-xs-center">Shopping list</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <v-btn icon color="purple">
                        <v-icon>search</v-icon>
                    </v-btn>
                </v-toolbar>
                <Product ref="product1" @updateShoppingList="getShoppingList" v-for="product in shoppingList" :product="product"> </Product>


                <v-form>
                    <v-container>
                        <v-layout row>
                            <v-combobox
          v-model="product.name"
          :items="products"
          label="Name"
        item-text="name"

          :return-object="false"

        ></v-combobox>
                            <v-text-field label="Amount" v-model="product.quantity"></v-text-field>
                            <v-btn color="cyan" @click="addProductToShoppingList(product)" dark>Add</v-btn>
                        </v-layout>
                    </v-container>
                </v-form>
            </v-card>
        </v-flex>
    </v-layout>
    <Alert ref='alert'>Added product to list! </Alert>

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
            model: null
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

        changeAlertState(){
            this.$refs.alert.showTheAlert();
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
            this.product.name = product.name
            console.log();
            axios.post('api/shopping-list/create', product)
                .then(response => {
                    this.getShoppingList();
                    this.changeAlertState();
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
