<template>
  <div>
    <v-layout row>
      <v-flex xs12 sm6 offset-sm3>
        <v-card>
          <v-toolbar color="cyan" dark>
            <v-toolbar-side-icon></v-toolbar-side-icon>

            <v-toolbar-title class="text-xs-center"
              >Shopping list</v-toolbar-title
            >

            <v-spacer></v-spacer>

            <v-btn icon> <v-icon>search</v-icon> </v-btn>
          </v-toolbar>
          <Product v-for="product in shoppingList" :product="product"> </Product>
          <v-card-actions>
            <v-text-field
              label="Product"
            ></v-text-field>
            <v-text-field label="Amount"></v-text-field>
            <v-btn color="cyan" dark>Add</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import Product from "./Product.vue";
import axios from 'axios';

export default {
  name: "ShoppingList",
  data() {
    return {
      shoppingList: []
    };
  },
  components: {
    Product
  },
  mounted(){
      this.getShoppingList();
  },
  methods: {

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
  }
},

};
</script>
