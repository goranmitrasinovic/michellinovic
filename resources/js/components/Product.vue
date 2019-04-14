<template>
  <div>
    <v-list subheader>
      <v-list-tile>
        <v-list-tile-content>
          <v-list-tile-title v-if="!editable"
            >
            {{product.quantity}} x {{product.name}}
          </v-list-tile-title>
          <input v-model="product.quantity" v-if="editable" />
          <input v-model="product.name" v-if="editable" />
        </v-list-tile-content>
        <v-btn v-if="!editable" color="warning" icon dark @click="editProduct()" >
            <v-icon dark>edit</v-icon>
        </v-btn>
        <v-btn v-if="editable" color="warning" dark @click="editProduct()" >
            Cancel
        </v-btn>
        <v-btn v-if="editable" color="success" dark >
            Save
        </v-btn>
        <v-list-tile-action v-if="!editable">
          <v-checkbox @change="completeProduct(product)" v-model="product.completed"></v-checkbox>
        </v-list-tile-action>
      </v-list-tile>
    </v-list>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Product",
  props: ["product"],
  data() {
    return {
      editable: false,
    };
  },
  methods: {
  editProduct() {
      this.editable = !this.editable;
  },

    completeProduct(product) {
            axios.put('api/shopping-list/update/' + product.id)
                .then(response => {
                    this.$emit('updateShoppingList')
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {

                });
        },
        
  }

};
</script>
