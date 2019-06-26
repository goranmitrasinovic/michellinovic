<template>
  <v-btn @click="handleClick" :color="type" :disabled="disabled">
    <slot>{{title}}</slot>
    <v-icon class="btn-icon" v-if="icon">{{icon}}</v-icon>
  </v-btn>
</template>

<script>
export default {
  data: function() {
    return {};
  },

  methods: {
    handleClick() {
      this.$emit("click");
    }
  },

  props: {
    title: {
      type: String,
      required: false
    },
    icon: {
      type: String,
      required: false
    },
    type: {
      type: String,
      default: "info",
      required: false
    },
    disabled: {
      type: Boolean,
      default: false,
      required: false
    }
  }
};
</script>

<style lang="css" scoped>
.btn-icon {
  padding: 0px 5px;
}
</style>
