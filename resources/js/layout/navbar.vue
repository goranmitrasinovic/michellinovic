<template>
  <nav>
    <div>
      <v-toolbar class="deep-purple" height="72px">
        <v-toolbar-title class="white--text mr-5">
          <router-link to="/">Michellinovic</router-link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
          <v-btn class="nav-btn" flat dark to="/shopping-list">
            <v-icon class="navbar-icon">shopping_cart</v-icon>Shopping list
          </v-btn>
          <v-btn class="nav-btn" flat dark to="/competition">
            <v-icon class="navbar-icon">casino</v-icon>Competition
          </v-btn>
          <v-btn class="nav-btn" flat dark to="/calendar">
            <v-icon class="navbar-icon">calendar_today</v-icon>Calendar
          </v-btn>
        </v-toolbar-items>
      </v-toolbar>
    </div>
  </nav>
</template>

<style scoped>
nav {
  /* To make box shadow be shown on top of container */
  z-index: 1;
  box-shadow: inset 0px -5px 20px -2px rgba(255, 255, 255, 0.15),
    0px 2px 20px 4px rgba(0, 0, 0, 0.4);
  font-family: Roboto, sans-serif;
}

.navbar-icon {
  margin: 0px 10px;
}

a {
  color: white;
}

a:hover:before {
  background-color: rgba(0, 0, 0, 0);
}

.nav-btn::after {
  position: absolute;
  content: "";
  bottom: 0;
  width: 90%;
  height: 3px;
  transform: scaleX(0);
  background-color: #fff;
  transition: all 0.3s;
}

.nav-btn:hover::after {
  transform: scale(1);
}
</style>
