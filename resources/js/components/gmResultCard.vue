<template>
  <div>
    <gmCard>
      <v-list-tile>
        <div class="arrow-box"></div>
        <v-list-tile-action>
          <v-icon>{{competition.icon}}</v-icon>
        </v-list-tile-action>

        <v-list-tile-action>
          <v-icon v-if="competition.score_home > competition.score_away" color="green">mood</v-icon>
          <v-icon
            v-if="competition.score_home == competition.score_away"
            color="orange"
          >sentiment_dissatisfied</v-icon>
          <v-icon v-if="competition.score_home < competition.score_away" color="red">mood_bad</v-icon>
        </v-list-tile-action>

        <v-list-tile-content class="score-container">
          <div class="score-box">{{competition.score_home}}</div>
          <span>-</span>
          <div class="score-box">{{competition.score_away}}</div>
        </v-list-tile-content>

        <v-list-tile-action>
          <v-icon v-if="competition.score_home < competition.score_away" color="green">mood</v-icon>
          <v-icon
            v-if="competition.score_home == competition.score_away"
            color="orange"
          >sentiment_dissatisfied</v-icon>
          <v-icon v-if="competition.score_home > competition.score_away" color="red">mood_bad</v-icon>
        </v-list-tile-action>
        <v-list-tile-action>
          <v-icon>{{competition.icon}}</v-icon>
        </v-list-tile-action>
      </v-list-tile>
      <v-divider></v-divider>
    </gmCard>
  </div>
</template>

<script>
import gmCard from "../base_components/gmCard";

export default {
  name: "gmResultCard",
  props: ["competition"],

  components: {
    gmCard
  }
};
</script>

<style scoped>
.score-container {
  flex-direction: row;
  align-items: center;
}

.score-box {
  background: #3f51b5;
  padding: 5px;
  color: white;
  width: 50px;
  margin: 0px 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: bold;
}
</style>
