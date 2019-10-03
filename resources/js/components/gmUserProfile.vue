<template>
  <v-flex xs12 sm4>
    <v-card>
      <v-img src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg" aspect-ratio="2.75"></v-img>

      <v-form>
        <v-container>
          <v-layout>
            <v-flex xs12 md6>
              <v-text-field v-model="user.name" label="Name"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="user.email" label="E-mail"></v-text-field>
            </v-flex>
          </v-layout>
        </v-container>
      </v-form>
      <v-card-actions class="justify-end">
        <v-btn flat color="orange" @click="updateUser(user)">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-flex>
</template>

<script>
import axios from "axios";

export default {
  props: {
    user: Object
  },

  methods: {
    updateUser(user) {
      axios
        .put("api/users/update/" + user.id, user)
        .then(response => {})
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    }
  }
};
</script>

<style>
.v-card {
  margin: 10px;
}
</style>
