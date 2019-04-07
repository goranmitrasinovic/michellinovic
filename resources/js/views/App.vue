<template>
<div>
    <navbar> </navbar>
    <v-content>
        <div class="container">
            <router-view></router-view>
        </div>
    </v-content>
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
