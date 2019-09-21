<template>
  <div>
    <gmNavbar></gmNavbar>
    <v-app>
      <v-content class="content">
        <div class="container">
          <router-view></router-view>
        </div>
      </v-content>
    </v-app>
  </div>
</template>
<script>
import axios from "axios";
import gmNavbar from "../base_components/gmNavbar.vue";

export default {
  data: () => ({
    user1: {}
  }),

  computed: {
    numberOfProducts: function() {
      return this.shoppingList.length;
    },
    todaysEvents: {
      get: function() {
        console.log("hej");
        return this.$store.getters.todaysEvents;
      },
      set: function() {
        console.log("setter");
      }
    }
  },

  components: {
    gmNavbar
  },

  mounted() {
    this.getUsers();
    this.getShoppingList();
    this.getEvents();
  },
  methods: {
    getUsers() {
      axios
        .get("api/users")
        .then(response => {
          this.$store.commit("UpdateUser1", response.data[0]);
          this.$store.commit("UpdateUser2", response.data[1]);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },

    getEvents() {
      axios
        .get("api/events")
        .then(response => {
          this.events = response.data;
          this.$store.commit("UpdateTodaysEvents", this.events);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },

    getShoppingList() {
      axios
        .get("api/shopping-list/uncompleted")
        .then(response => {
          this.shoppingList = response.data;
          this.$store.commit("UpdateNumberOfProducts", this.numberOfProducts);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    }
  }
};
</script>

<style>
.content {
  background: linear-gradient(120deg, #a6c0fe 0%, #d0def5 100%);
}
</style>
