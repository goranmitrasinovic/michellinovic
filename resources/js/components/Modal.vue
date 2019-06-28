<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">{{modalToogle}}</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">{{title}}</span>
        </v-card-title>
        <v-container>
          <slot name="introduction"></slot>
          <Event :event="event" :user1="user1" :user2="user2"></Event>
        </v-container>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="createEvent(event)">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
import axios from "axios";
import Event from "./Event";
import { log } from "util";

export default {
  data: () => ({
    dialog: false,
    event: {}
  }),

  components: {
    Event
  },

  methods: {
    createEvent(event) {
      this.dialog = false;
      this.$emit("update");
      axios
        .post("api/events/create", event)
        .then(response => {
          //   console.log(response);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed'
        });
    }
  },

  props: {
    title: String,
    modalToogle: String,
    user1: Object,
    user2: Object
  }
};
</script>
