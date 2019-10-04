<template>
  <div v-if="!fetching">
    <v-layout row>
      <v-flex xs12 sm6 offset-sm3>
        <gmCard
          :title="'Shopping list ' + '(' + $store.getters.numberOfProducts + ' items' + ')'"
          :menuItems="menuItems"
          @clicked="action"
        >
          <v-form>
            <v-container class="add-product">
              <v-layout row>
                <v-flex sm4 md5>
                  <v-combobox
                    v-model="product.name"
                    :items="products"
                    label="Product name"
                    item-text="name"
                    :return-object="false"
                    prepend-inner-icon="shopping_cart"
                  ></v-combobox>
                </v-flex>
                <v-flex sm4 md5>
                  <v-text-field
                    label="Amount"
                    prepend-inner-icon="exposure"
                    v-model="product.quantity"
                  ></v-text-field>
                </v-flex>
                <v-flex sm4 md4 lg3 xl1>
                  <gmButton
                    :disabled="(!product.name || !product.quantity)"
                    @click="addProductToShoppingList(product)"
                  >Add</gmButton>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
          <!-- If list of products is empty -->
          <div v-if="shoppingList.length < 1" class="empty-cart-container">
            <v-icon class="empty-cart-icon" color="green">shopping_cart</v-icon>
            <p class="empty-cart-text">No items in your shoppinglist. Good job!</p>
          </div>

          <transition-group name="card">
            <Product
              class="product"
              ref="product1"
              @updateShoppingList="getShoppingList"
              v-for="product in shoppingList"
              :product="product"
              :key="product.id"
            ></Product>
          </transition-group>
        </gmCard>
      </v-flex>
      <gmSnackbar ref="snackbarSuccess" type="primary" text="Added product!"></gmSnackbar>
      <gmSnackbar ref="snackbarFailure" type="error" text="Could not add product!"></gmSnackbar>
    </v-layout>
  </div>
</template>

<script>
import Product from "./Product.vue";
import gmSnackbar from "../base_components/gmSnackbar";
import gmButton from "../base_components/gmButton";
import gmCard from "../base_components/gmCard";
import axios from "axios";

export default {
  name: "ShoppingList",
  data() {
    return {
      shoppingList: [],
      fetching: true,
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
    gmButton,
    gmCard,
    gmSnackbar
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
          this.$store.commit(
            "UpdateNumberOfProducts",
            this.shoppingList.length
          );
          this.fetching = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    },

    action(item) {
      if (item.title === "Clear list") {
        this.clearList();
      } else {
        console.log(item.title);
      }
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
          product.quantity = "";
          product.name = "";
          this.$refs.snackbarSuccess.toogleSnackbar();
        })
        .catch(error => {
          this.$refs.snackbarFailure.toogleSnackbar();
        })
        .then(function() {});
    }
  }
};
</script>

<style scoped>
.bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
  -webkit-transform-origin: center bottom;
  transform-origin: center bottom;
}

.add-product {
  background: #fff;
  border-bottom: 2px solid #3f51b5;
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

.theme--light.v-sheet {
  margin: 10px 0px;
  padding-bottom: 10px;
}

.product >>> .v-list--two-line .v-list__tile {
  padding: 0px;
  border-bottom-left-radius: 10px;
}

.empty-cart-icon {
  font-size: 200px;
}

.empty-cart-text {
  color: grey;
  font-size: 32px;
}

.empty-cart-container {
  text-align: center;
  padding: 50px;
}

.product {
  margin: 10px;
}

@media screen and (max-width: 992px) {
  .empty-cart-icon {
    font-size: 26px;
  }
  .empty-cart-text {
    font-size: 22px;
  }
}
</style>
