<template>
<v-card>
    <v-toolbar color="indigo" dark>
        <v-menu>
            <template v-slot:activator="{ on }">
                <v-spacer></v-spacer>
                <v-toolbar-title>{{title}}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-side-icon v-on="on">
                  <v-icon>menu</v-icon>
                </v-toolbar-side-icon>
            </template>
            <v-list>
              <v-list-tile
                v-for="(item, index) in menuItems"
                :key="index"
                @click="$emit('clicked', item)"
              >
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile>
            </v-list>
        </v-menu>
    </v-toolbar>
    <slot></slot>
</v-card>
</template>

<script>
export default {
    data() {
        return {

        };
    },


    props: {
        title: String,
        menuItems: Array,
    }
};
</script>
