<template>
  <div>
    <gmCard title="Calendar" :menuItems="menuItems" @clicked="action">
      <v-layout wrap>
        <v-flex xs12 class="mb-3">
          <v-sheet height="500">
            <v-calendar
              ref="calendar"
              v-model="start"
              type="month"
              color="primary"
              :weekdays="weekdays"
            >
              <template v-slot:day="{ date }">
                <template v-for="event in eventsMap[date]">
                  <div
                    v-if="!event.time"
                    :key="event.title"
                    v-ripple
                    @click="openModal(event)"
                    class="my-event"
                    v-html="event.title"
                  ></div>
                </template>
              </template>
            </v-calendar>
          </v-sheet>
        </v-flex>
        <gmModal
          ref="modal"
          @save="updateEvent(event)"
          :title="event.title"
          @edit="toogleEditMode"
          :editButton="true"
        >
          <v-layout wrap>
            <v-flex xs12>
              <v-text-field
                prepend-icon="calendar_today"
                :disabled="!editMode"
                label="Date"
                v-model="event.date"
              ></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                prepend-icon="info"
                label="Details"
                :disabled="!editMode"
                v-model="event.details"
              ></v-text-field>
            </v-flex>
          </v-layout>
        </gmModal>
        <v-flex sm6 xs12 class="text-sm-left text-xs-center">
          <v-btn @click="$refs.calendar.prev()">
            <v-icon dark left>keyboard_arrow_left</v-icon>Prev
          </v-btn>
        </v-flex>

        <v-flex sm6 xs12 class="text-sm-right text-xs-center">
          <v-btn @click="$refs.calendar.next()">
            Next
            <v-icon right dark>keyboard_arrow_right</v-icon>
          </v-btn>
        </v-flex>
      </v-layout>
    </gmCard>
    <gmModal ref="createModal" @save="createEvent(event)">
      <v-text-field label="Date" v-model="event.date"></v-text-field>
      <v-text-field label="Title" v-model="event.title"></v-text-field>
      <v-text-field label="Description" v-model="event.details"></v-text-field>
    </gmModal>
  </div>
</template>



<script>
import gmButton from "../base_components/gmButton";
import gmModal from "../base_components/gmModal";
import gmCard from "../base_components/gmCard";
import axios from "axios";
import { log } from "util";

export default {
  data: () => ({
    start: new Date().toISOString().slice(0, 10),
    today: "2019-01-08",
    editMode: false,
    weekdays: [1, 2, 3, 4, 5, 6, 0],
    menuItems: [
      {
        title: "Create event"
      }
    ],
    event: {},
    events: []
  }),

  components: {
    gmButton,
    gmModal,
    gmCard
  },

  computed: {
    // convert the list of events into a map of lists keyed by date
    eventsMap() {
      const map = {};
      this.events.forEach(e => (map[e.date] = map[e.date] || []).push(e));
      return map;
    }
  },

  mounted() {
    this.getEvents();
  },

  methods: {
    open(event) {
      alert(event.title);
    },

    action(item) {
      if (item.title === "Create event") {
        this.openCreateModal();
      } else {
        console.log(item.title);
      }
    },

    openModal(event) {
      this.event = event;
      this.$refs.modal.showModal();
    },

    openCreateModal() {
      this.$refs.createModal.showModal();
    },

    toogleEditMode() {
      this.editMode = !this.editMode;
    },

    addEvent(event) {
      this.events.push(event);
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
    },

    updateEvent(event) {
      axios
        .put("api/events/update/" + event.id, event)
        .then(response => {})
        .catch(error => {})
        .then(function() {});
    },

    createEvent(event) {
      axios
        .post("api/events/create", event)
        .then(response => {
          this.getEvents();
          this.event = {};
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {});
    }
  }
};
</script>


<style scoped>
.my-event {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  border-radius: 2px;
  background-color: #1867c0;
  color: #ffffff;
  border: 1px solid #1867c0;
  font-size: 14px;
  padding: 2px;
  cursor: pointer;
  margin-bottom: 1px;
  left: 4px;
  margin-right: 8px;
  position: relative;
}

.with-time {
  position: absolute;
  right: 4px;
  margin-right: 0px;
}

.create-event-container {
  margin-bottom: 20px;
  border-bottom: 2px solid #3f51b5;
}

.theme--light.v-sheet {
  border: 1px solid #570fc1;
}

.icon-area {
  background: gainsboro;
  padding: 2px 10px;
}
</style>
