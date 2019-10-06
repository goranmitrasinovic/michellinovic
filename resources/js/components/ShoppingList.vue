<template>
  <div v-if="!fetching">
    <!-- <v-text-field v-model="searchString">test</v-text-field>
    <v-btn @click="searchProducts(searchString)">sök</v-btn>

    <v-container fluid grid-list-md>
      <v-layout row wrap>
        <v-flex xs12 xs6 md4 lg3 v-for="product in searchResults" :key="product.id">
          <v-card class="search-card">
            <img :src="product.image_small_url" />
            <div class="search-card-text">
              Name: {{product.product_name_sv}}
              <br />
              Ingredients: {{product.ingredients_text_sv}}
              <br />
              Sugar/100g: {{product.nutriments.sugars_100g}}g
            </div>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>-->

    <v-layout row>
      <v-flex xs12 sm8 offset-sm2>
        <gmCard :title="'Shopping list'" :menuItems="menuItems" @clicked="action">
          <v-tabs centered color="light-blue darken-1" dark icons-and-text grow>
            <v-tabs-slider color="white"></v-tabs-slider>

            <v-tab href="#tab-grocery" @click="updateCategory('Grocery')">
              Groceries
              <v-icon>restaurant</v-icon>
            </v-tab>

            <v-tab href="#tab-clothes" id="tab-clothes" @click="updateCategory('Clothes')">
              Clothes
              <v-icon>accessibility</v-icon>
            </v-tab>

            <v-tab href="#tab-other" id="tab-other" @click="updateCategory('Other')">
              Other
              <v-icon>shopping_basket</v-icon>
            </v-tab>
            <v-tab-item class="tab-content-container" :value="'tab-grocery'">
              <v-card flat>
                <transition-group name="card">
                  <Product
                    class="product"
                    @updateShoppingList="getAllProducts"
                    v-for="product in groceryProducts"
                    :product="product"
                    :key="product.id"
                  ></Product>
                </transition-group>
              </v-card>
            </v-tab-item>
            <v-tab-item class="tab-content-container" :value="'tab-clothes'">
              <v-card flat>
                <transition-group name="1">
                  <Product
                    class="product"
                    @updateShoppingList="getAllProducts"
                    v-for="product in clothesProducts"
                    :product="product"
                    :key="product.id"
                  ></Product>
                </transition-group>
              </v-card>
            </v-tab-item>
            <v-tab-item class="tab-content-container" :value="'tab-other'">
              <v-card flat>
                <transition-group name="2">
                  <Product
                    class="product"
                    @updateShoppingList="getAllProducts"
                    v-for="product in otherProducts"
                    :product="product"
                    :key="product.id"
                  ></Product>
                </transition-group>
              </v-card>
            </v-tab-item>
          </v-tabs>
          <v-form>
            <v-container class="add-product">
              <v-layout row>
                <v-flex sm4>
                  <v-combobox
                    v-model="product.name"
                    :items="products"
                    label="Product name"
                    item-text="name"
                    :return-object="false"
                    prepend-inner-icon="shopping_cart"
                  ></v-combobox>
                </v-flex>
                <v-flex sm4>
                  <v-text-field label="Category" v-model="product.category"></v-text-field>
                </v-flex>
                <v-flex sm2>
                  <v-text-field
                    label="Amount"
                    prepend-inner-icon="exposure"
                    v-model="product.quantity"
                  ></v-text-field>
                </v-flex>
                <v-flex sm2>
                  <gmButton
                    :disabled="(!product.name || !product.quantity)"
                    @click="addProductToShoppingList(product)"
                  >Add</gmButton>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
          <!-- If list of products is empty -->
          <!-- <div v-if="shoppingList.length < 1" class="empty-cart-container">
            <v-icon class="empty-cart-icon" color="green">shopping_cart</v-icon>
            <p class="empty-cart-text">No items in your shoppinglist. Good job!</p>
          </div>-->

          <!-- <transition-group name="card">
            <Product
              class="product"
              ref="product1"
              @updateShoppingList="getShoppingList"
              v-for="product in shoppingList"
              :product="product"
              :key="product.id"
            ></Product>
          </transition-group>-->
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
      fetching: true,
      products: [],
      product: { category: "Grocery" },
      otherProducts: [],
      groceryProducts: [],
      clothesProducts: [],
      searchString: "",
      searchResults: {},
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
    this.getAllProducts();
  },

  methods: {
    updateCategory(category) {
      this.product.category = category;
      return this.product;
    },

    clearList(shoppingList) {
      axios
        .put("api/shopping-list/clear-list", shoppingList)
        .then(response => {
          this.getShoppingList();
        })
        .catch(function(error) {})
        .then(function() {});
    },

    getOtherProducts() {
      axios
        .get("api/shopping-list/other-products")
        .then(response => {
          this.otherProducts = response.data;
          this.fetching = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    },
    getGroceryProducts() {
      axios
        .get("api/shopping-list/grocery-products")
        .then(response => {
          this.groceryProducts = response.data;
          this.fetching = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    },
    getClothesProducts() {
      axios
        .get("api/shopping-list/clothes-products")
        .then(response => {
          this.clothesProducts = response.data;
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
      this.getOtherProducts();
      this.getGroceryProducts();
      this.getClothesProducts();
    },

    searchProducts() {
      axios
        .get(
          "https://se.openfoodfacts.org/cgi/search.pl?search_terms=" +
            this.searchString +
            "&search_simple=1&action=process&json=1"
        )
        .then(response => {
          this.searchResults = response.data.products;
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
          product.quantity = "";
          product.name = "";
          this.getAllProducts();
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
  background: #ddecff;
  border: 2px solid #3f51b5;
}

.card-enter-active {
  position: absolute;
}

.v-tabs {
  border: 2px solid #3f51b5;
}

.tab-content-container {
  padding: 20px 0px;
}

.search-card {
  padding: 10px;
  display: flex;
}

.search-card-text {
  padding: 5px;
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
  margin: 10px;
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

.v-tabs >>> .v-tabs__bar {
  box-shadow: 0px 3px 8px 0px grey;
}

#tab-other {
  background: #3bc3aa;
}
#tab-clothes {
  background: #ea5c8a;
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
