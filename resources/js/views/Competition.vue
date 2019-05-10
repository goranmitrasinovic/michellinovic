<template>
<v-layout row>
    <v-flex xs12 sm6 offset-sm3>
        <v-card>
            <v-toolbar color="indigo" dark>

                <v-toolbar-side-icon></v-toolbar-side-icon>

                <v-toolbar-title>Inbox</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>search</v-icon>
                </v-btn>

                <v-btn icon>
                    <v-icon>more_vert</v-icon>
                </v-btn>
            </v-toolbar>

            <v-list>
                <v-list-tile>
                  <v-list-tile-action>
                    {{user2.name}}
                  </v-list-tile-action>

                  <v-list-tile-content>
                    <v-list-tile-title class="bold">Result</v-list-tile-title>
                  </v-list-tile-content>

                  <v-list-tile-action>
                    {{user2.name}}
                  </v-list-tile-action>
                </v-list-tile>
            <div v-for="result in results">
              <v-list-tile>
                <v-list-tile-action>
                  <v-icon color="red">star</v-icon>
                </v-list-tile-action>
                <v-list-tile-action>
                  <v-icon color="blue">person</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>{{result.score}}</v-list-tile-title>
                </v-list-tile-content>

                <v-list-tile-action>
                  <v-icon color="pink">person</v-icon>
                </v-list-tile-action>
                <v-list-tile-action>
                  <v-icon color="red">star</v-icon>
                </v-list-tile-action>
              </v-list-tile>
          </div>
        </v-list>
        </v-card>
    </v-flex>
</v-layout>
</template>

<script>

import axios from 'axios';

export default {

    data: function() {
        return {
            users: [],
            results: [{sport: 'Soccer', score: "2-1"}],
            user1: {name: 'Goran Mitrasinovic'},
            user2: {name: 'Michelle Anton'}
        }
    },

    mounted() {
        this.getUsers();
    },

    methods: {
    getUsers() {
        axios.get('api/users')
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
    }
}

}

</script>

<style scoped>
    .v-list__tile__title{
        text-align: center;
    }
</style>
