<template>
  <div class="text-center mt-n2">
    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn v-bind="attrs" v-on="on" icon dark>
          <v-icon class="shadow-4" :color="color">notifications </v-icon
          >{{ unreadCount }}
        </v-btn>
      </template>
      <v-list>
        <v-list-item v-for="item in unread" :key="item.id">
          <router-link :to="item.path">
            <v-list-item-title @click="readnotification(item)">{{
              item.question
            }}</v-list-item-title>
          </router-link>
        </v-list-item>
        <v-divider></v-divider>
        <v-list-item v-for="item in read" :key="item.id">
          <v-list-item-title>{{ item.question }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>
<script>
export default {
  data() {
    return {
      read: {},
      unread: {},
      unreadCount: 0,
    };
  },
  created() {
    if (User.loggedIn()) {
      this.getNotification();
    }
  },
  computed: {
    color() {
      return this.unreadCount > 0 ? "pink" : "red lighten-4";
    },
  },
  methods: {
    getNotification() {
      axios.post("/api/notifications").then((res) => {
        console.log(res);
        this.read = res.data.read;
        this.unread = res.data.unread;
        if (this.unreadCount) {
          this.unreadCount = res.data.unread.length;
        }
      });
    },
    readnotification(notification) {
      axios.post("/api/markAsRead", { id: notification.id }).then((res) => {
        this.unread.splice(notification, 1);
        this.read.push(notification);
        this.unreadCount--;
      });
    },
  },
};
</script>
