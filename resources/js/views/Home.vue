<template>
  <v-container fluid grid-list-md>
    <v-layout justify-center row wrap>
      <v-flex xs12 sm4>
        <gmCard :hideMenu="true">
          <div class="icon-container">
            <v-icon class="empty-cart-icon" color="orange">shopping_cart</v-icon>
          </div>
          <div class="number-text">
            <div class="header">Shoppinglist</div>
            <div>{{$store.getters.numberOfProducts}}</div>
          </div>
        </gmCard>
      </v-flex>
      <v-flex xs12 sm4>
        <gmCard :hideMenu="true">
          <div class="icon-container">
            <v-icon class="empty-cart-icon" color="primary">calendar_today</v-icon>
          </div>
          <div class="number-text">
            <div class="header">Events today</div>
            <div class="event" v-for="daily in dailys" :key="daily.id">{{daily.title}}</div>
            <span v-if="!dailys.length">There are no events today</span>
          </div>
        </gmCard>
      </v-flex>
    </v-layout>
  </v-container>
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
    },
    // Get all events that matches todays date
    dailys() {
      let dailys = [];
      let today = new Date().toISOString().slice(0, 10);

      this.$store.getters.todaysEvents.forEach(e => {
        if (e.date === today) {
          dailys.push(e);
        }
      });
      return dailys;
    }
  }
};
</script>

<style scoped>
.v-card {
  padding: 10px;
  align-items: stretch;
}

.event {
  background: #1867c0;
  color: white;
  padding: 10px;
  margin: 5px 0px;
  font-size: 18px;
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
