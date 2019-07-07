<template>
  <div>
    <v-layout>
      <v-flex>
        <v-sheet height="500">
          <v-calendar :now="today" :value="today" color="primary">
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
          <gmModal ref="modal" :title="event.title" :editButton="true">
            <v-layout wrap>
              <v-flex xs2>
                <v-icon class="icon-area">home</v-icon>
              </v-flex>
              <v-flex xs10>
                <v-text-field label="Date" v-model="event.date"></v-text-field>
              </v-flex>
              <v-flex xs2>
                <v-icon class="icon-area">home</v-icon>
              </v-flex>
              <v-flex xs10>
                <v-text-field label="Details" v-model="event.details"></v-text-field>
              </v-flex>
            </v-layout>
          </gmModal>
        </v-sheet>
      </v-flex>
    </v-layout>
    <v-layout wrap>
      <v-flex sm4 xs12 class="text-sm-left text-xs-center">
        <v-btn @click="$refs.calendar.prev()">
          <v-icon dark left>keyboard_arrow_left</v-icon>Prev
        </v-btn>
      </v-flex>
      <v-flex sm4 xs12 class="text-xs-center">
        <v-select v-model="type" :items="typeOptions" label="Type"></v-select>
      </v-flex>
      <v-flex sm4 xs12 class="text-sm-right text-xs-center">
        <v-btn @click="$refs.calendar.next()">
          Next
          <v-icon right dark>keyboard_arrow_right</v-icon>
        </v-btn>
      </v-flex>
    </v-layout>
  </div>
</template>


<script>
import gmButton from "../base_components/gmButton";
import gmModal from "../base_components/gmModal";

export default {
  data: () => ({
    type: "month",
    start: "2019-01-01",
    end: "2019-01-06",
    typeOptions: [
      { text: "Day", value: "day" },
      { text: "4 Day", value: "4day" },
      { text: "Week", value: "week" },
      { text: "Month", value: "month" },
      { text: "Custom Daily", value: "custom-daily" },
      { text: "Custom Weekly", value: "custom-weekly" }
    ],
    today: "2019-01-08",
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
