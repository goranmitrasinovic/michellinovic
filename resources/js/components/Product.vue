<template>
  <div>
    <v-list subheader>
      <v-list-tile>
        <v-list-tile-content>
          <v-list-tile-title v-if="!editable"
            >
            {{product}}
            <!-- {{ product.quantity }}x - {{ product.title }} -->
          </v-list-tile-title>
          <!-- <input v-model="product.quantity" v-if="editable" /> -->
          <input v-model="product.title" v-if="editable" />
        </v-list-tile-content>
        <v-icon @click="editProduct();">edit</v-icon>
        <v-list-tile-action>
          <!-- <v-checkbox v-model="product.completed"></v-checkbox> -->
        </v-list-tile-action>
      </v-list-tile>
    </v-list>
  </div>
</template>

<script>
export default {
  name: "Product",
  props: ["product"],
  data() {
    return {
      editable: false
    };
  },
  methods: {
    editProduct() {
      this.editable = !this.editable;
    }
  }
};
</script>
