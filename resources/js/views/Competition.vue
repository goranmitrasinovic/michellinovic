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


export default {

data: function () {
   return {
     results: [{name: 'name', sport: 'sport', score: '1 - 2'}, {name: 'name2', sport: 'sport2', score: '23 - 12'}]
   }
}
}

</script>

<style scoped>
    .v-list__tile__title{
        text-align: center;
    }
    </style>
