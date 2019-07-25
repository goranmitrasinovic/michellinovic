<template>
  <v-card>
    <v-toolbar color="indigo" dark>
      <v-spacer></v-spacer>
      <v-toolbar-title>Calendar</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-toolbar-side-icon></v-toolbar-side-icon>
    </v-toolbar>
    <v-layout wrap>
      <v-flex xs12 class="mb-3">
        <v-sheet height="500">
          <v-calendar ref="calendar" v-model="start" type="month" :end="end" color="primary">
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
      <gmModal ref="modal" :title="event.title" @edit="toogleEditMode" :editButton="true">
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
  </v-card>
</template>



<script>
import gmButton from "../base_components/gmButton";
import gmModal from "../base_components/gmModal";

export default {
  data: () => ({
    start: "2019-01-01",
    end: "2019-01-06",
    today: "2019-01-08",
    editMode: false,
    newEvent: {},
    event: {},
    events: [
      {
        title: "Vacation",
        details: "Going to the beach!",
        date: "2018-12-30",
        open: false
      },
      {
        title: "Vacation",
        details: "Going to the beach!",
        date: "2018-12-31",
        open: false
      },
      {
        title: "Vacation",
        details: "Going to the beach!",
        date: "2019-01-01",
        open: false
      },
      {
        title: "Meeting",
        details: "Spending time on how we do not have enough time",
        date: "2019-01-07",
        open: false
      },
      {
        title: "30th Birthday",
        details: "Celebrate responsibly",
        date: "2019-01-03",
        open: false
      },
      {
        title: "New Year",
        details: "Eat chocolate until you pass out",
        date: "2019-01-01",
        open: false
      },
      {
        title: "Conference",
        details: "Mute myself the whole time and wonder why I am on this call",
        date: "2019-01-21",
        open: false
      },
      {
        title: "Hackathon",
        details: "Code like there is no tommorrow",
        date: "2019-02-01",
        open: false
      }
    ]
  }),

  components: {
    gmButton,
    gmModal
  },

  computed: {
    // convert the list of events into a map of lists keyed by date
    eventsMap() {
      const map = {};
      this.events.forEach(e => (map[e.date] = map[e.date] || []).push(e));
      return map;
    }
  },
  methods: {
    open(event) {
      alert(event.title);
    },

    openModal(event) {
      this.event = event;
      this.$refs.modal.showModal();
    },

    toogleEditMode() {
      this.editMode = !this.editMode;
    },

    addEvent(event) {
      this.events.push(event);
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
