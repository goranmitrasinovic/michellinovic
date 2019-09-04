<template>
  <div>
    {{$store.getters.numberOfProducts}}
    <v-card max-width="344" class="mx-auto">
      <v-card-title style="background: red;">Shopping list</v-card-title>
      <v-card-text>There is currently 'placeholder' products to be bought</v-card-text>
      <v-card-actions>
        <v-layout align-center justify-end>
          <v-btn text>Go to Shopping list</v-btn>
        </v-layout>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import gmButton from "../base_components/gmButton";
import gmModal from "../base_components/gmModal";

export default {
  components: {
    gmButton,
    gmModal
  },

  methods: {
    consoleClick() {
      console.log("Button clicked");
    },
    saveData() {
      console.log("Data saved");
    }
  }
};
</script>

<style>
</style>
