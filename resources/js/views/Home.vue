<template>
  <div>
    <gmModal @save="saveData" toogleText="Open" title="Test">heeeej</gmModal>
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
