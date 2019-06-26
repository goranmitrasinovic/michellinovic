<template>
  <div>
    <v-alert v-model="alert" type="success" outline transition="scale-transition">
      <slot></slot>
    </v-alert>
  </div>
</template>

<script>
export default {
  name: "Alert",

  props: {
    type: String
  },

  data() {
    return {
      alert: false
    };
  },

  methods: {
    showTheAlert() {
      this.alert = !this.alert;
      this.$emit("showTheAlert");
      setTimeout(() => {
        this.alert = !this.alert;
      }, 1500);
    }
  }
};
</script>

<style lang="css" scoped>
</style>
