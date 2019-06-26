<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">{{toogleText}}</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">{{title}}</span>
        </v-card-title>
        <v-container>
          <slot></slot>
        </v-container>

        <v-card-actions>
          <v-spacer></v-spacer>
          <gmButton type="warning" @click="closeModal">Close</gmButton>
          <gmButton type="success" @click="saveModal">Save</gmButton>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
import axios from "axios";
import gmButton from "./gmButton";

export default {
  data: () => ({
    dialog: false
  }),

  methods: {
    closeModal() {
      this.dialog = false;
    },
    saveModal() {
      this.dialog = false;
      this.$emit("save");
    }
  },

  components: {
    gmButton
  },

  props: {
    title: String,
    toogleText: String
  }
};
</script>
