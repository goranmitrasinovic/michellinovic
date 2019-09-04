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
import gmNavbar from "../base_components/gmNavbar.vue";

export default {
  components: {
    gmNavbar
  }
};
</script>

<style>
.content {
  background: linear-gradient(120deg, #a6c0fe 0%, #d0def5 100%);
}
</style>
