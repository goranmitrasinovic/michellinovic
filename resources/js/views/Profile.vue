<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm2>
      <v-card>
        <v-img src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg" aspect-ratio="2.75"></v-img>

        <v-form>
          <v-container>
            <v-layout>
              <v-flex xs12 md6>
                <v-text-field v-model="goran.name" label="Name"></v-text-field>
              </v-flex>
              <v-flex xs12 md6>
                <v-text-field v-model="goran.email" label="E-mail"></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-form>

        <v-card-actions class="justify-end">
          <v-btn flat color="orange" @click="updateUser(goran)">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
    <v-flex xs12 sm4>
      <v-card>
        <v-img src="https://cdn.vuetifyjs.com/images/cards/desert.jpg" aspect-ratio="2.75"></v-img>

        <v-form>
          <v-container>
            <v-layout>
              <v-flex xs12 md6>
                <v-text-field v-model="users[1].name" label="Name"></v-text-field>
              </v-flex>
              <v-flex xs12 md6>
                <v-text-field v-model="users[1].email" label="E-mail"></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-form>

        <v-card-actions class="justify-end">
          <v-btn flat color="orange" @click="updateUser(michelle)">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from "axios";
export default {
  data: function() {
    return {
      goran: {},
      michelle: {},
      users: []
    };
  },

  mounted() {
    this.getUsers();
  },

  methods: {
    getUsers() {
      axios
        .get("api/users")
        .then(response => {
          console.log(response.data);
          this.users = response.data;
          this.goran = response.data[0];
          this.michelle = response.data[1];
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },
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

<style scoped>
.v-card {
  margin: 10px;
}
</style>
