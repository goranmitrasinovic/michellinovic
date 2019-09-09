<template>
  <div>
    <!-- <v-layout row>
      <v-flex xs12 sm6 offset-sm3>
        <gmCard title="Notices">
          <v-layout>
            <v-flex xs12 sm6>
              <v-card style="margin: 10px;">
                <v-img src="https://cdn.vuetifyjs.com/images/cards/desert.jpg" aspect-ratio="2.75"></v-img>

                <v-card-title primary-title>
                  <div>
                    <h3 class="headline mb-0">Kangaroo Valley Safari</h3>
                    <div>ds</div>
                  </div>
                </v-card-title>

                <v-card-actions>
                  <v-btn flat color="orange">Share</v-btn>
                  <v-btn flat color="orange">Explore</v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
            <v-flex xs12 sm6>
              <v-card style="margin: 10px;">
                <v-img src="https://cdn.vuetifyjs.com/images/cards/desert.jpg" aspect-ratio="2.75"></v-img>

                <v-card-title primary-title>
                  <div>
                    <h3 class="headline mb-0">Kangaroo Valley Safari</h3>
                    <div>ds</div>
                  </div>
                </v-card-title>

                <v-card-actions>
                  <v-btn flat color="orange">Share</v-btn>
                  <v-btn flat color="orange">Explore</v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </gmCard>
      </v-flex>
    </v-layout>-->
  </div>
</template>

<script>
import Shoppinglist from "../components/ShoppingList.vue";
import gmButton from "../base_components/gmButton";
import gmModal from "../base_components/gmModal";
import gmCard from "../base_components/gmCard";

export default {
  components: {
    gmButton,
    gmModal,
    gmCard,
    Shoppinglist
  },

  computed: {
    productsCount() {
      return this.$store.getters.numberOfProducts;
    }
  },

  methods: {
    consoleClick() {
      console.log("Button clicked");
    },
    saveData() {
      console.log("Data saved");
    }
  }
};
</script>

<style scoped>
</style>
