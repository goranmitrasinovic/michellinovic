<template>
  <v-container fluid grid-list-md>
    <!-- <draggable v-model="trelloCardsNotStarted" group="cards" @start="drag=true" @end="drag=false">
      <div
        style="border: 1px solid red; padding: 20px; background: grey;"
        v-for="card in trelloCardsNotStarted"
        :key="card.id"
      >{{card.name}}</div>
    </draggable>
    <draggable v-model="trelloCardsStarted" group="cards" @start="drag=true" @end="drag=false">
      <div
        style="border: 1px solid red; padding: 20px; background: grey;"
        v-for="card in trelloCardsStarted"
        :key="card.id"
      >{{card.name}}</div>
    </draggable>-->
    <v-layout justify-center row wrap>
      <v-flex xs12 sm4>
        <gmCard class="list" title="Not Started">
          <gmCard
            class="not-started"
            :hideMenu="true"
            v-for="card in trelloCardsNotStarted"
            :key="card.id"
          >{{card.name}}</gmCard>
        </gmCard>
      </v-flex>
      <v-flex xs12 sm4>
        <gmCard class="list" title="In Progress">
          <gmCard
            :hideMenu="true"
            class="started"
            v-for="card in trelloCardsStarted"
            :key="card.id"
          >{{card.name}}</gmCard>
        </gmCard>
      </v-flex>
      <v-flex xs12 sm4>
        <gmCard class="list" title="Completed">
          <gmCard
            :hideMenu="true"
            class="completed"
            v-for="card in trelloCardsCompleted"
            :key="card.id"
          >{{card.name}}</gmCard>
        </gmCard>
      </v-flex>
    </v-layout>
    <v-btn @click="createCard()">Skapa kort</v-btn>
  </v-container>
</template>

<script>
import axios from "axios";
import draggable from "vuedraggable";

import gmCard from "../base_components/gmCard";

export default {
  data: function() {
    return {
      trelloBoard: [],
      trelloLists: [],
      trelloCards: [],
      trelloCardsNotStarted: [],
      trelloCardsStarted: [],
      trelloCardsCompleted: []
    };
  },

  components: {
    gmCard,
    draggable
  },

  mounted() {
    this.getBoards();
    this.getLists();
    this.getNotStartedCards();
    this.getStartedCards();
    this.getCompletedCards();
  },

  methods: {
    getBoards() {
      axios
        .get(
          "https://api.trello.com/1/boards/6OZc9u7m?actions=all&boardStars=none&cards=none&card_pluginData=false&checklists=none&customFields=false&fields=name%2Cdesc%2CdescData%2Cclosed%2CidOrganization%2Cpinned%2Curl%2CshortUrl%2Cprefs%2ClabelNames&lists=open&members=none&memberships=none&membersInvited=none&membersInvited_fields=all&pluginData=false&organization=false&organization_pluginData=false&myPrefs=false&tags=false&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.trelloBoard = response.data;
        });
    },
    getLists() {
      axios
        .get(
          "https://api.trello.com/1/boards/6OZc9u7m/lists?cards=all&card_fields=all&filter=open&fields=all&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.trelloLists = response.data;
          console.log(response);
        });
    },
    getNotStartedCards() {
      axios
        .get(
          "https://api.trello.com/1/list/5d8234e419c8693d7c0822b1/cards?fields=id,name,badges,labels&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.trelloCardsNotStarted = response.data;
        });
    },
    getStartedCards() {
      axios
        .get(
          "https://api.trello.com/1/list/5d8234e78b5a4f5ab45734c8/cards?fields=id,name,badges,labels&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.trelloCardsStarted = response.data;
        });
    },
    getCompletedCards() {
      axios
        .get(
          "https://api.trello.com/1/list/5d8234e9f520502601e63601/cards?fields=id,name,badges,labels&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.trelloCardsCompleted = response.data;
        });
    },
    createCard() {
      axios
        .post(
          "https://api.trello.com/1/cards?name=test&idList=5d8234e9f520502601e63601&keepFromSource=all&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          console.log("hej");
        });
    }
  }
};
</script>

<style scoped>
.list.v-card {
  padding-bottom: 10px;
}

.not-started.v-card {
  padding: 10px;
  margin: 10px;
  background: #c0d2de;
}

.started.v-card {
  padding: 10px;
  margin: 10px;
  background: #fffaa4;
}

.completed.v-card {
  padding: 10px;
  margin: 10px;
  background: #98e88c;
}
</style>
