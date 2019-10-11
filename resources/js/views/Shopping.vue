<template>
  <gm-shoppinglist></gm-shoppinglist>
</template>

<script>
import gmShoppinglist from "../components/gmShoppingList.vue";
import axios from "axios";

export default {
  data: function() {
    return {};
  },

  methods: {
    getProducts() {
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
    }
  },

  components: {
    gmShoppinglist
  }
};
</script>
