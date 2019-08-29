<template>
  <v-layout row>
    <v-flex xs12 sm6 offset-sm3>
      <gmModal ref="modal" title="Create competition" @save="createCompetition(competition)">
        <v-layout row justify-center>
          <v-container>
            <slot name="introduction"></slot>
            <gmCreateCompetition :competition="competition" :user1="user1" :user2="user2"></gmCreateCompetition>
          </v-container>
        </v-layout>
      </gmModal>
      <gmCard title="Competition" :menuItems="menuItems" @clicked="action">
        <v-list>
          <!-- <div class="filter-container">
            <v-select
              :items="sports"
              @change="applyFilter"
              v-model="filter.sport"
              label="Sport"
              item-text="name"
            ></v-select>
          </div>-->

          <v-container grid-list-md>
            <v-layout row align-center justify-space-between text-xs-center>
              <v-flex xs12 sm4>
                <img
                  class="avatar mirrored"
                  src="https://image.shutterstock.com/image-vector/angry-man-avatar-user-pic-260nw-578255422.jpg"
                />
                <br />
                <h3>{{user1.name}}</h3>
              </v-flex>
              <v-flex xs12 sm4>Result</v-flex>
              <v-flex xs12 sm4>
                <img
                  class="avatar"
                  src="https://image.shutterstock.com/image-vector/angry-man-avatar-user-pic-260nw-578255422.jpg"
                />
                <br />
                <h3>{{user2.name}}</h3>
              </v-flex>
            </v-layout>
          </v-container>
          <gmResultCard
            v-for="competition in competitions"
            :key="competition.id"
            :competition="competition"
          ></gmResultCard>
        </v-list>
      </gmCard>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from "axios";
import gmModal from "../base_components/gmModal";
import gmCreateCompetition from "../components/gmCreateCompetition";
import gmResultCard from "../components/gmResultCard";
import gmCard from "../base_components/gmCard";

export default {
  data: function() {
    return {
      users: [],
      dialog: false,
      competition: {},
      competitions: [],
      menuItems: [
        {
          title: "Create competition"
        }
      ],
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
    gmModal,
    gmCreateCompetition,
    gmResultCard,
    gmCard
  },

  mounted() {
    this.getUsers();
    this.getCompetitions();
  },

  methods: {
    action(item) {
      if (item.title === "Create competition") {
        this.openModal();
      } else {
        console.log(item.title);
      }
    },

    openModal() {
      this.$refs.modal.showModal();
    },

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

    createCompetition(competition) {
      this.dialog = false;
      axios
        .post("api/competitions/create", competition)
        .then(response => {
          this.getCompetitions();
          this.competition = {};
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed'
        });
    },

    getCompetitions() {
      axios
        .get("api/competitions")
        .then(response => {
          this.competitions = response.data;
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

.avatar {
  border-radius: 200px;
  border: 3px solid #3f51b5;
  width: 74px;
}
</style>
