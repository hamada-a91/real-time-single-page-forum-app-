
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
        <router-link
          v-for="item in items"
          :key="item.title"
          :to="item.to"
          v-if="item.show"
        >
          <v-btn text> {{ item.title }}</v-btn>
        </router-link>
      </div>
    </v-toolbar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { title: "Forum", to: "/forum", show: true },
        { title: "Login", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() },
        { title: "Ask Question", to: "/ask", show: User.loggedIn() },
        { title: "Category", to: "/category", show: User.loggedIn() },
      ],
    };
  },
  created() {
    EventBus.$on("logout", () => {
      User.logout();
    });
  },
};
</script>

<style>
</style>