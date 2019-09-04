<template>
  <v-layout row justify-center>
    <v-container grid-list-md>
      <v-layout wrap>
        <v-flex xs>
          <v-select
            v-model="competition.sport"
            :items="sports"
            label="Sport"
            item-text="name"
            item-value="name"
          ></v-select>
        </v-flex>
        <v-flex xs12 sm6 md6>
          <v-text-field v-model="competition.score_home" :label="user1.name + ' score'"></v-text-field>
        </v-flex>
        <v-flex xs12 sm6 md6>
          <v-text-field v-model="competition.score_away" :label="user2.name + ' score'"></v-text-field>
        </v-flex>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
export default {
  name: "Competition",
  data: () => ({
    sports: [
      { name: "Basketball" },
      { name: "Soccer" },
      { name: "Golf" },
      { name: "Yatzy" }
    ]
  }),
  props: {
    competition: Object,
    user1: Object,
    user2: Object
  }
};
</script>

<style lang="css" scoped>
.v-list__tile {
  margin: 10px;
  border-radius: 10px;
  background: #fff;
}
</style>
