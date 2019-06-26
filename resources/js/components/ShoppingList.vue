<template>
  <div>
    <v-layout row>
      <v-flex xs12 sm6 offset-sm3>
        <v-card>
          <v-toolbar color="purple" dark>
            <v-menu offset-y>
              <template v-slot:activator="{ on }">
                <v-toolbar-side-icon v-on="on">
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
            <v-toolbar-title class="text-xs-center">Shopping list ({{shoppingList.length}} items)</v-toolbar-title>
          </v-toolbar>
          <v-form>
            <v-container class="add-product">
              <v-layout row>
                <v-flex xs4 md5>
                  <v-combobox
                    v-model="product.name"
                    :items="products"
                    label="Name"
                    item-text="name"
                    :return-object="false"
                  ></v-combobox>
                </v-flex>
                <v-flex xs4 md5>
                  <v-text-field label="Amount" v-model="product.quantity"></v-text-field>
                </v-flex>
                <v-flex xs4 md2>
                  <gmButton
                    :disabled="(!product.name || !product.quantity)"
                    @click="addProductToShoppingList(product)"
                  >Add</gmButton>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
          <transition-group name="card">
            <Product
              ref="product1"
              @updateShoppingList="getShoppingList"
              v-for="product in shoppingList"
              :product="product"
              :key="product.id"
            ></Product>
          </transition-group>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import Product from "./Product.vue";
import Alert from "./Alert.vue";
import gmButton from "../base_components/gmButton";
import axios from "axios";

export default {
  name: "ShoppingList",
  data() {
    return {
      shoppingList: [],
      products: [],
      product: {},
      menuItems: [
        {
          title: "Clear list"
        }
      ]
    };
  },
  components: {
    Product,
    Alert,
    gmButton
  },
  mounted() {
    this.getShoppingList();
    this.getAllProducts();
  },
  methods: {
    clearList(shoppingList) {
      axios
        .put("api/shopping-list/clear-list", shoppingList)
        .then(response => {
          this.getShoppingList();
        })
        .catch(function(error) {})
        .then(function() {});
    },

    getShoppingList() {
      axios
        .get("api/shopping-list/uncompleted")
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
      axios
        .get("api/products")
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
      axios
        .post("api/product/create", product)
        .then(response => {
          this.getShoppingList();
        })
        .catch(function(error) {
          console.log(error);
        })
        .then(function() {
          product.quantity = "";
          product.name = "";
        });
    }
  }
};
</script>

<style>
.bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
  -webkit-transform-origin: center bottom;
  transform-origin: center bottom;
}

.add-product {
  background: #f6f0ff;
  border-bottom: 2px solid #570fc1;
}

.card-enter-active {
  position: absolute;
}

.card-leave-active {
  position: absolute;
  display: none;
  right: 0;
}

.card-move {
  transition: all 0.5s;
}
</style>
