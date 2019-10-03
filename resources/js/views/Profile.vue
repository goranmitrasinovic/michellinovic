<template>
  <v-layout justify-center>
    <gm-user-profile :user="user1"></gm-user-profile>
    <gm-user-profile :user="user2"></gm-user-profile>
  </v-layout>
</template>

<script>
import axios from "axios";
import gmUserProfile from "../components/gmUserProfile.vue";

export default {
  components: {
    gmUserProfile
  },

  computed: {
    user1() {
      return this.$store.getters.user1;
    },
    user2() {
      return this.$store.getters.user2;
    }
  }
};
</script>

<style scoped>
.v-card {
  margin: 10px;
}
</style>
