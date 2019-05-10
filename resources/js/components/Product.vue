<template>
<div>
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
                    <v-list-tile-title>
                        {{product.name}} ({{product.quantity}} units)
                    </v-list-tile-title>
                </v-list-tile-content>
                <v-btn v-if="!editable" color="warning" icon dark @click="editProduct()">
                    <v-icon dark>edit</v-icon>
                </v-btn>
                <v-text-field v-model="product.name" label="Name" v-if="editable"></v-text-field>
                <v-text-field v-model="product.quantity" label="Amount" v-if="editable"></v-text-field>


                <v-btn v-if="editable" color="warning" dark @click="editProduct()">
                    Cancel
                </v-btn>
                <v-btn v-if="editable" color="success" dark @click="updateProduct(product)">
                    Save
                </v-btn>
                <v-divider class="mx-3" inset vertical></v-divider>
                <v-list-tile-action v-if="!editable">
                    <v-btn color="success" @click="completeProduct(product)" v-model="product.completed">Complete</v-btn>
                </v-list-tile-action>
            </v-list-tile>
            <v-divider></v-divider>
        </v-list>
    </div>
    <Alert ref='alert'>You have removed a product!</Alert>
</div>
</template>

<script>
import axios from 'axios';
import Alert from './Alert.vue';

export default {
    name: "Product",
    props: ["product"],

    components: {
        Alert
    },
    data() {
        return {
            editable: false,
            saving: false,
        };
    },
    methods: {
        editProduct() {
            this.editable = !this.editable;
            this.$emit('updateShoppingList');
        },

        completeProduct(product) {
            this.saving = true;
            axios.put('api/shopping-list/product/' + product.id)
                .then(response => {
                    this.saving = true;
                    this.$emit('updateShoppingList')
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {

                });
        },

        updateProduct(product) {
            axios.put('api/shopping-list/edit-product/' + product.id, product)
                .then(response => {
                    this.$emit('updateShoppingList')
                    this.editProduct();
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

<style>

/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all 1s ease;
}
.slide-fade-leave-active {
  transition: all 1s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}

</style>
