<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <gmCard :hideMenu="true">
        <div class="flex">
          <div>
            <v-icon class="empty-cart-icon" color="orange">shopping_cart</v-icon>
          </div>
          <div class="number-text">
            <div class="header">Shoppinglist</div>
            <div>{{$store.getters.numberOfProducts}}</div>
          </div>
        </div>
      </gmCard>
    </v-flex>
  </v-layout>
</template>

<script>
import Shoppinglist from "../components/ShoppingList.vue";
import gmButton from "../base_components/gmButton";
import gmModal from "../base_components/gmModal";
import gmCard from "../base_components/gmCard";

export default {
  components: {
    gmButton,
    gmModal,
    gmCard,
    Shoppinglist
  },

  computed: {
    productsCount() {
      return this.$store.getters.numberOfProducts;
    }
  }
};
</script>

<style scoped>
.flex {
  padding: 10px;
  display: flex;
  align-items: center;
}

.empty-cart-icon {
  font-size: 30px;
  margin: 0px 20px 0px 0px;
}

.header {
  color: grey;
  font-size: 14px;
  text-transform: uppercase;
}

.number-text {
  font-size: 20px;
}
</style>
