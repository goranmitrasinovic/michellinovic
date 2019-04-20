<template>
<div>
<div>
    <v-list two-line>
        <v-list-tile>
            <v-list-tile-action v-if="!editable">
                <v-icon color="indigo">add_shopping_cart</v-icon>
            </v-list-tile-action>
            <v-list-tile-content v-if="!editable">
                <v-list-tile-title>
                    {{product.name}} ({{product.quantity}} units)
                </v-list-tile-title>
            </v-list-tile-content>
            <v-btn v-if="!editable" color="warning" icon dark @click="editProduct()">
                <v-icon dark>edit</v-icon>
            </v-btn>

            <v-text-field v-model="product.quantity" label="Amount" v-if="editable"></v-text-field>

            <v-text-field v-model="product.name" label="Name" v-if="editable"></v-text-field>

            <v-btn v-if="editable" color="warning" dark @click="editProduct()">
                Cancel
            </v-btn>
            <v-btn v-if="editable" color="success" dark @click="updateProduct(product)">
                Save
            </v-btn>
            <v-divider class="mx-3" inset vertical></v-divider>
            <v-list-tile-action v-if="!editable">
                <v-checkbox @change="completeProduct(product)" v-model="product.completed"></v-checkbox>
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
        };
    },
    methods: {

        changeAlertState(){
            this.$refs.alert.showTheAlert();
        },

        editProduct() {
            this.editable = !this.editable;
            this.$emit('updateShoppingList');
        },

        completeProduct(product) {
            axios.put('api/shopping-list/product/' + product.id)
                .then(response => {
                    this.$emit('updateShoppingList')
                    this.changeAlertState();
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
.v-input--selection-controls__ripple {
    position: relative;
}
</style>
