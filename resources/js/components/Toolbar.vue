<template>
  <div>
    <v-toolbar
      dark
      prominent
      src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>AskTime</v-toolbar-title>

      <v-spacer></v-spacer>
      <div>
        <router-link to="/forum">
          <v-btn text> Forum</v-btn>
        </router-link>
        <router-link to="/ask"> <v-btn text> Ask Question</v-btn> </router-link>
        <router-link to="/category">
          <v-btn text> Category</v-btn>
        </router-link>
        <router-link to="/login"> <v-btn text> Login</v-btn> </router-link>
      </div>
    </v-toolbar>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>