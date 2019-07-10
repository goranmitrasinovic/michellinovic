<template>
  <div>
    <v-list two-line>
      <v-list-tile class="product-container">
        <v-list-tile-action
          class="checkbox-container"
          v-if="!editable"
          @click="completeProduct(product)"
        >
          <transition :duration="{ enter: 50, leave: 50 }" name="slide-fade" mode="out-in">
            <v-checkbox color="success" class="v-checkbox" v-model="product.completed"></v-checkbox>
          </transition>
        </v-list-tile-action>
        <v-list-tile-content v-if="!editable">
          <v-list-tile-title :class="(saving) ? 'completed' : 's'">
            {{product.name}}
            <span style="font-size: 16px">({{product.quantity}} units)</span>
          </v-list-tile-title>
        </v-list-tile-content>
        <v-text-field v-model="product.name" class="edit-input" label="Name" v-if="editable"></v-text-field>
        <v-text-field v-model="product.quantity" class="edit-input" label="Amount" v-if="editable"></v-text-field>
        <v-list-tile-action
          v-bind:class="{ 'action-container': !editable, 'action-container-edit' : editable }"
        >
          <gmButton v-if="editable" type="warning" @click="editProduct" key="cancel">Cancel</gmButton>
          <gmButton v-if="editable" type="success" @click="updateProduct(product)" key="save">Save</gmButton>
          <!-- <v-icon v-if="editable" @click="editProduct" class="edit-icon">edit</v-icon>
          <v-icon v-if="editable" @click="editProduct" class="edit-icon">edit</v-icon>-->

          <v-icon v-if="!editable" @click="editProduct" class="edit-icon">edit</v-icon>
        </v-list-tile-action>
      </v-list-tile>
    </v-list>
    <gmSnackbar ref="snackbar" text="Saved"></gmSnackbar>
  </div>
</template>

<script>
import axios from "axios";
import gmButton from "../base_components/gmButton";
import gmSnackbar from "../base_components/gmSnackbar";
import { log } from "util";

export default {
  name: "Product",
  props: ["product"],

  components: {
    gmButton,
    gmSnackbar
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
      // Shouldnt have to set this to see the checkbox ticked in the view, todo
      product.completed = 1;
      this.$refs.snackbar.toogleSnackbar();
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
      this.$refs.snackbar.toogleSnackbar();
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

<style scoped>
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

.theme--light.v-list {
  background: white;
  border-radius: 10px;
  margin: 10px;
  padding: 0px;
}

.v-list__tile__title {
  letter-spacing: 0.5px;
  margin: 10px;
  font-size: 22px;
  color: #585858;
}

.v-input--checkbox {
  flex: none;
  display: block;
  margin: 0 auto;
}

.v-list >>> .v-list__tile__content {
  border: 1px solid gainsboro;
  box-shadow: inset 0px -39px 98px -38px rgba(139, 213, 240, 0.46);
}

.edit-icon {
  color: white;
  padding: 10px;
}

.edit-input {
  margin: 10px;
}

.v-list__tile__avatar {
  justify-content: center;
}

.v-list >>> .v-input--selection-controls__input {
  margin-right: 0px;
}

.v-list >>> .v-list__tile__action--stack {
  align-items: center;
}

.checkbox-container {
  background: #e5fff4;
  border: 1px solid #1ea95e;
  border-bottom-left-radius: 10px;
  border-top-left-radius: 10px;
}

.checkbox-container:hover {
  cursor: pointer;
}

.action-container {
  background: #1976d2;
  justify-content: center !important;
  border: 1px solid #1450d1;
}

.action-container-edit {
  border: none;
  justify-content: center !important;
}
</style>
