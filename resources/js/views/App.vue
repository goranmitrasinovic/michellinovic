<template>
<div>
    <navbar> </navbar>
    <v-app>
    <v-content>
        <div class="container">
            <router-view></router-view>
        </div>
    </v-content>
</v-app>
</div>
</template>
<script>
import Navbar from "../layout/navbar.vue";

export default{
    components: {
      Navbar
    }
}
</script>
