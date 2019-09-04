<template>
  <div>
    <v-card class="outer-card" @click="openModal()">
      <div class="sport-container">
        <div class="sport-box">
          <span class="sport-text">{{competition.sport}}</span>
        </div>
      </div>
      <v-list-tile>
        <div class="participant participant-home">
          <span>{{user1.name}}</span>
        </div>
        <v-list-tile-content class="score-container">
          <div class="score-box">{{competition.score_home}}</div>
          <span>-</span>
          <div class="score-box">{{competition.score_away}}</div>
        </v-list-tile-content>
        <div class="participant participant-away">{{user2.name}}</div>
      </v-list-tile>
    </v-card>
    <v-divider></v-divider>
    <gmModal
      ref="updateModal"
      :competition="competition"
      :user1="user1"
      :user2="user2"
      @save="updateCompetition(competition)"
      @close="getCompetitions()"
    >
      <v-layout row justify-center>
        <v-container grid-list-md>
          <v-layout wrap>
            <v-flex xs12>
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
    </gmModal>
  </div>
</template>

<script>
import axios from "axios";
import gmCard from "../base_components/gmCard";
import gmModal from "../base_components/gmModal";

export default {
  name: "gmResultCard",
  props: ["competition"],
  data: () => ({
    sports: [
      { name: "Basketball" },
      { name: "Soccer" },
      { name: "Golf" },
      { name: "Yatzy" }
    ],
    user1: {
      name: "Goran Mitrasinovic"
    },
    user2: {
      name: "Michelle Anton"
    }
  }),

  methods: {
    updateCompetition(competition) {
      axios
        .put("api/competitions/update/" + competition.id, competition)
        .then(response => {
          this.$emit("getCompetitions");
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          this.$emit("getCompetitions");
        });
    },

    getCompetitions() {
      this.$emit("update");
    },

    openModal() {
      this.$refs.updateModal.showModal();
    }
  },

  components: {
    gmCard,
    gmModal
  }
};
</script>

<style scoped>
.outer-card {
  box-shadow: none;
  margin: 20px 5px;
  border-radius: 10px;
}

.outer-card >>> .v-list__tile {
  padding: 0px;
  border: 3px solid #3e3e3e;
  border-radius: 15px;
  height: 50px;
  background: linear-gradient(
    to bottom,
    rgba(19, 19, 19, 1) 0%,
    rgba(76, 76, 76, 1) 100%
  );
}

.theme--light.v-sheet {
  padding: 5px;
  background-color: rgba(0, 0, 0, 0);
}

.participant {
  display: flex;
  flex: 4;
  height: 100%;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  color: rgb(47, 47, 47);
}

.sport-box {
  text-align: center;
  background: #55526f;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-left: 2px solid #3e3e3e;
  border-top: 2px solid #3e3e3e;
  border-right: 2px solid #3e3e3e;
  width: 33%;
  padding: 10px;
  margin: 0 auto;
  color: white;
  font-size: 18px;
  font-weight: bold;
}

.participant-home {
  clip-path: polygon(0 0, 80% 0%, 100% 100%, 0% 100%);
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  background: linear-gradient(
    to right,
    rgba(255, 149, 130, 1) 0%,
    rgba(230, 78, 64, 1) 100%
  );
}

.participant-away {
  clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  background: linear-gradient(
    to right,
    rgba(69, 143, 222, 1) 0%,
    rgba(130, 205, 255, 1) 100%
  );
}
.v-card:hover {
  cursor: pointer;
}

.score-container {
  flex-direction: row;
  align-items: center;
  color: white;
  background: linear-gradient(
    to bottom,
    rgba(19, 19, 19, 1) 0%,
    rgba(76, 76, 76, 1) 100%
  );
}

.score-box {
  padding: 5px;
  width: 75px;
  white-space: nowrap;
  text-align: center;
  font-size: 24px;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: bold;
}
</style>
