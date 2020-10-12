
<template>
  <div>
    <v-toolbar
      dark
      prominent
      src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
      height="80"
    >
      <v-toolbar-title>AskTime</v-toolbar-title>

      <v-spacer></v-spacer>
      <appNotification v-if="logged"></appNotification>

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
import AppNotification from "./AppNotificatoin";
export default {
  components: { AppNotification },
  data() {
    return {
      logged: User.loggedIn(),
      items: [
        { title: "All Questions", to: "/forum", show: true },
        { title: "Login", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() },
        { title: "Ask Question", to: "/ask", show: User.loggedIn() },
        { title: "Category", to: "/category", show: User.admin() },
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