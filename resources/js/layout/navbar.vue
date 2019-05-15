<template>
    <v-toolbar class="deep-purple">
        <v-toolbar-title class="white--text mr-5">Michellinovic</v-toolbar-title>
        <v-toolbar-items>
            <v-btn class="px-3 mx-2" flat dark to="/shopping-list"> Shopping list</v-btn>
            <v-btn class="px-3 mx-2" flat dark to="/competition"> Competition</v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<style scoped>

.v-btn--active:before, .v-btn:focus:before{
    background-color: none;
}


</style>
