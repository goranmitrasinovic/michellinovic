<template>
<div>
    <Shoppinglist> </Shoppinglist>
    <!-- <button @click="addProduct"> lägg till produkt </button> -->
</div>
</template>

<script>
import Shoppinglist from "../components/ShoppingList.vue";
import axios from 'axios';

export default {

    data: function() {
        return {
        }
    },


    methods: {
        getProducts() {
            axios.get('api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }
    },

    components: {
        Shoppinglist
    }
}
</script>
