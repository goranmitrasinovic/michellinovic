<template>
  <v-layout row>
    <v-flex xs12 sm6 offset-sm3>
      <Modal
        title="Add event"
        modalToogle="Create event"
        @update="getEvents"
        :user1="user1"
        :user2="user2"
      >
        <template v-slot:introduction>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
          ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
          laborum.
        </template>
      </Modal>
      <v-card>
        <v-toolbar color="indigo" dark>
          <v-toolbar-side-icon></v-toolbar-side-icon>

          <v-toolbar-title>Competition</v-toolbar-title>
        </v-toolbar>

        <v-list>
          <div class="filter-container">
            <v-select
              :items="sports"
              @change="applyFilter"
              v-model="filter.sport"
              label="Sport"
              item-text="name"
            ></v-select>
          </div>
          <v-container grid-list-md>
            <v-layout row align-center justify-space-between text-xs-center>
              <v-flex xs12 sm4>
                <img
                  width="64px"
                  style="transform: scaleX(-1); border-radius: 200px;"
                  src="https://image.shutterstock.com/image-vector/angry-man-avatar-user-pic-260nw-578255422.jpg"
                />
                <br />

                {{user2.name}}
              </v-flex>
              <v-flex xs12 sm4>Result</v-flex>
              <v-flex xs12 sm4>
                <img
                  width="64px"
                  style="border-radius: 200px;"
                  src="https://image.shutterstock.com/image-vector/angry-man-avatar-user-pic-260nw-578255422.jpg"
                />
                <br />
                {{user1.name}}
              </v-flex>
            </v-layout>
          </v-container>
          <div v-for="event in events" class="event-list-item">
            <v-list-tile>
              <v-list-tile-action>
                <v-icon>{{event.icon}}</v-icon>
              </v-list-tile-action>
              <v-list-tile-action>
                <v-icon v-if="event.score_home > event.score_away" color="green">mood</v-icon>
                <v-icon
                  v-if="event.score_home == event.score_away"
                  color="orange"
                >sentiment_dissatisfied</v-icon>
                <v-icon v-if="event.score_home < event.score_away" color="red">mood_bad</v-icon>
              </v-list-tile-action>

              <v-list-tile-content>
                <v-list-tile-title>{{event.score_home}} - {{event.score_away}}</v-list-tile-title>
              </v-list-tile-content>

              <v-list-tile-action>
                <v-icon v-if="event.score_home < event.score_away" color="green">mood</v-icon>
                <v-icon
                  v-if="event.score_home == event.score_away"
                  color="orange"
                >sentiment_dissatisfied</v-icon>
                <v-icon v-if="event.score_home > event.score_away" color="red">mood_bad</v-icon>
              </v-list-tile-action>
              <v-list-tile-action>
                <v-icon>{{event.icon}}</v-icon>
              </v-list-tile-action>
            </v-list-tile>
            <v-divider></v-divider>
          </div>
        </v-list>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from "axios";
import Modal from "../components/Modal";

export default {
  data: function() {
    return {
      users: [],
      events: [],
      filter: { sport: "All" },
      sports: [
        { name: "All" },
        { name: "Basketball" },
        { name: "Fotball" },
        { name: "Golf" }
      ],
      user1: {
        name: "Goran Mitrasinovic"
      },
      user2: {
        name: "Michelle Anton"
      }
    };
  },

  components: {
    Modal,
    Event
  },

  mounted() {
    this.getUsers();
    this.getEvents();
  },

  methods: {
    getUsers() {
      axios
        .get("api/users")
        .then(response => {
          this.users = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },

    applyFilter() {
      console.log("hej");
    },

    getEvents() {
      axios
        .get("api/events")
        .then(response => {
          this.events = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    }
  }
};
</script>

<style scoped>
.v-list__tile__title {
  text-align: center;
}

.v-list {
  padding: 0px;
}

.filter-container {
  background: #fff;
  border-bottom: 2px solid #3f51b5;
  padding: 10px;
}

.theme--light.v-list {
  background: #e7f4ff;
  border: 1px solid #570fc1;
}

.event-list-item {
  margin: 10px;
  border-radius: 10px;
  background: #fff;
  border: 1px solid #570fc1;
}
</style>
