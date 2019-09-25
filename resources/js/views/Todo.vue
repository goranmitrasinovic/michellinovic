<template>
  <v-container fluid grid-list-md>
    <v-layout justify-center row wrap>
      <v-flex xs12 sm4>
        <gmCard class="list" title="Not Started">
          <gmCard
            class="todo-card not-started"
            :hideMenu="true"
            @click.native="openModal(card)"
            v-for="card in trelloCardsNotStarted"
            :key="card.id"
          >{{card.name}}</gmCard>
          <v-container grid-list-md text-xs-center>
            <v-layout row wrap>
              <v-flex sm12 md6>
                <v-text-field v-model="cardName" label="Namn">Namn:</v-text-field>
              </v-flex>
              <v-flex sm12 md6>
                <v-btn @click="createCard()">Skapa kort</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </gmCard>
      </v-flex>
      <v-flex xs12 sm4>
        <gmCard class="list" title="In Progress">
          <gmCard
            :hideMenu="true"
            @click.native="openModal(card)"
            class="todo-card started"
            v-for="card in trelloCardsStarted"
            :key="card.id"
          >{{card.name}}</gmCard>
        </gmCard>
      </v-flex>
      <v-flex xs12 sm4>
        <gmCard class="list" title="Completed">
          <gmCard
            :hideMenu="true"
            @click.native="openModal(card)"
            class="todo-card completed"
            v-for="card in trelloCardsCompleted"
            :key="card.id"
          >{{card.name}}</gmCard>
        </gmCard>
      </v-flex>

      <gmModal ref="modal" title="Card" @save="updateCard(card)">
        <v-layout row justify-center>
          <v-container>
            <slot name="introduction"></slot>
            <v-text-field v-model="card.name" label="Name">Name</v-text-field>
            <v-select
              :items="trelloLists"
              v-model="listId"
              label="List"
              item-text="name"
              item-value="id"
            ></v-select>
          </v-container>
        </v-layout>
      </gmModal>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
import gmModal from "../base_components/gmModal";

import gmCard from "../base_components/gmCard";

export default {
  data: function() {
    return {
      cardName: "",
      card: {},
      listId: "",
      dialog: false,
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
    gmModal
  },

  mounted() {
    this.getBoards();
    this.getLists();
    this.getNotStartedCards();
    this.getStartedCards();
    this.getCompletedCards();
  },

  methods: {
    openModal(card) {
      this.$refs.modal.showModal();
      this.card = card;
      this.getCardList(card);
    },
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
          console.log(this.trelloLists);
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
          "https://api.trello.com/1/cards?name=" +
            this.cardName +
            "&idList=5d8234e419c8693d7c0822b1&keepFromSource=all&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.getNotStartedCards();
          this.cardName = "";
        });
    },
    updateCard(card) {
      axios
        .put(
          "https://api.trello.com/1/cards/" +
            card.id +
            "?name=" +
            card.name +
            "&idList=" +
            this.listId +
            "&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.getNotStartedCards();
          this.getStartedCards();
          this.getCompletedCards();
        });
    },
    getCardList(card) {
      axios
        .get(
          "https://api.trello.com/1/cards/" +
            card.id +
            "/list?fields=all&key=1238ec18c06ef8fabe9d26357cfbdbd9&token=4be3dcd1677488a9070b1a9f547a82c72593041ac4da008dccdc927f74d27487"
        )
        .then(response => {
          this.card.list = response.data;
          this.listId = response.data.id;
          this.getNotStartedCards();
          this.getStartedCards();
          this.getCompletedCards();
        });
    },
    moveCard(card) {
      console.log(card);
    }
  }
};
</script>

<style scoped>
.todo-card {
  padding: 20px;
  margin: 10px;
  font-size: 18px;
}

.todo-card:hover {
  cursor: pointer;
  filter: brightness(125%);
}

.list.v-card {
  padding-bottom: 10px;
}

.not-started.v-card {
  background: #c0d2de;
}

.started.v-card {
  background: #fff2a4;
}

.completed.v-card {
  background: #98e88c;
}
</style>
