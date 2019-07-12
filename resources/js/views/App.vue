<template>
  <div>
    <Navbar></Navbar>
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
import Navbar from "../layout/navbar.vue";

export default {
  components: {
    Navbar
  }
};
</script>

<style>
.content {
  background: linear-gradient(120deg, #a6c0fe 0%, #f68084 100%);
}
</style>
