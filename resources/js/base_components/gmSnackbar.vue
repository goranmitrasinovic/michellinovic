<template>
  <v-card>
    <v-snackbar
      v-model="snackbar"
      :bottom="y === 'bottom'"
      :left="x === 'left'"
      :multi-line="mode === 'multi-line'"
      :right="x === 'right'"
      :timeout="timeout"
      :top="y === 'top'"
      :color="'primary'"
      :vertical="mode === 'vertical'"
    >{{ text }}</v-snackbar>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      snackbar: false,
      y: "top",
      x: "right",
      mode: "",
      timeout: 2000
    };
  },

  methods: {
    toogleSnackbar() {
      this.snackbar = true;
    }
  },

  props: {
    text: String
  }
};
</script>
