<template>
  <v-layout row justify-center>
    <v-container grid-list-md>
      <v-layout wrap>
        <v-flex xs8>
          <v-text-field v-model="event.sport" label="sport"></v-text-field>
        </v-flex>
        <v-flex xs4>
          <v-select
            v-model="event.icon"
            :items="icons"
            label="Icon"
            item-text="name"
            item-value="icon"
          ></v-select>
        </v-flex>
        <v-flex xs12 sm6 md6>
          <v-text-field v-model="event.score_home" :label="user1.name + ' score'"></v-text-field>
        </v-flex>
        <v-flex xs12 sm6 md6>
          <v-text-field v-model="event.score_away" :label="user2.name + ' score'"></v-text-field>
        </v-flex>
      </v-layout>
      {{event}}
    </v-container>
  </v-layout>
</template>

<script>
export default {
  name: "Event",
  data: () => ({
    icons: [
      { name: "Basketball", icon: "fiber_manual_record" },
      { name: "Boardgame", icon: "casino" },
      { name: "Bowling", icon: "" },
      { name: "Golf", icon: "golf_course" },
      { name: "Video game", icon: "computer" }
    ]
  }),
  props: {
    event: Object,
    user1: Object,
    user2: Object
  }
};
</script>

<style lang="css" scoped>
</style>
