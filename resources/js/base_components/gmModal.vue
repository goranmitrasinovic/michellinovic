<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title class="modal-header">
          <span class="headline">{{title}}</span>
        </v-card-title>
        <v-container>
          <slot></slot>
        </v-container>

        <v-card-actions>
          <v-spacer></v-spacer>
          <gmButton type="warning" @click="closeModal">Close</gmButton>
          <gmButton v-if="editButton" type="primary" @click="editModal">Edit</gmButton>
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
    showModal() {
      this.dialog = true;
    },
    saveModal() {
      this.dialog = false;
      this.$emit("save");
    },
    editModal() {
      this.$emit("edit");
    }
  },

  components: {
    gmButton
  },

  props: {
    title: String,
    editButton: Boolean,
    toogleText: String
  }
};
</script>

<style scoped>
.modal-header {
  background: #507fb3;
  color: white;
}
</style>
