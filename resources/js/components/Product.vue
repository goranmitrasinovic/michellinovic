<template>
  <div>
    <v-list two-line>
      <v-list-tile>
        <v-list-tile-action v-if="!editable">
          <transition :duration="{ enter: 50, leave: 50 }" name="slide-fade" mode="out-in">
            <v-icon v-if="!saving" color="indigo" key="save">add_shopping_cart</v-icon>
            <v-icon v-if="saving" color="green" key="done">done</v-icon>
          </transition>
        </v-list-tile-action>

        <v-list-tile-content v-if="!editable">
          <v-list-tile-title
            :class="(saving) ? 'completed' : 's'"
          >{{product.name}} ({{product.quantity}} units)</v-list-tile-title>
        </v-list-tile-content>

        <gmButton v-if="!editable" type="warning" icon="edit" @click="editProduct"/>

        <v-text-field v-model="product.name" label="Name" v-if="editable"></v-text-field>
        <v-text-field v-model="product.quantity" label="Amount" v-if="editable"></v-text-field>

        <gmButton v-if="editable" type="warning" @click="editProduct">Cancel</gmButton>

        <gmButton v-if="editable" type="success" @click="updateProduct(product)">Save</gmButton>

        <v-divider v-if="!editable" class="mx-3" inset vertical></v-divider>
        <v-list-tile-action v-if="!editable">
          <gmButton
            type="success"
            @click="completeProduct(product)"
            v-model="product.completed"
          >Complete</gmButton>
        </v-list-tile-action>
      </v-list-tile>
      <v-divider></v-divider>
    </v-list>
  </div>
</template>

<script>
import axios from "axios";
import gmButton from "../base_components/gmButton";

export default {
  name: "Product",
  props: ["product"],

  components: {
    gmButton
  },
  data() {
    return {
      editable: false,
      saving: false
    };
  },
  methods: {
    editProduct() {
      this.editable = !this.editable;
      this.$emit("updateShoppingList");
    },

    completeProduct(product) {
      this.saving = true;
      axios
        .put("api/shopping-list/product/" + product.id)
        .then(response => {
          this.$emit("updateShoppingList");
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    },

    updateProduct(product) {
      axios
        .put("api/shopping-list/edit-product/" + product.id, product)
        .then(response => {
          this.$emit("updateShoppingList");
          this.editProduct();
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    }
  }
};
</script>

<style>
.slide-fade-enter-active {
  transition: all 1s ease;
}
.slide-fade-leave-active {
  transition: all 1s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
  transform: translateX(10px);
  opacity: 0;
}

.completed {
  text-decoration: line-through;
}
</style>
