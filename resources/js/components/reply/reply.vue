<template>
  <div class="mt-1">
    <v-container>
      <v-card class="mx-auto my-0" rounded="5" max-width="57%" color="white">
        <v-card-title>
          <div class="headline">{{ data.user }}</div>
          <div class="ml-3 grey--text">{{ data.created_at }}</div>
          <v-spacer></v-spacer>
          <like :content="data"></like>
        </v-card-title>
        <v-divider></v-divider>

        <edit-reply :reply="data" v-if="editing"></edit-reply>
        <v-card-text v-else>
          <p>{{ data.reply }}</p>
        </v-card-text>
        <v-divider></v-divider>
        <div v-if="!editing">
          <v-card-actions v-if="own">
            <v-btn>
              <v-icon @click="edit" color="orange "> edit</v-icon>
            </v-btn>
            <v-btn @click="destroy">
              <v-icon color="red "> delete</v-icon>
            </v-btn>
          </v-card-actions>
        </div>
      </v-card>
    </v-container>
  </div>
</template>

<script>
import EditReply from "./editReply";
import like from "../likes/like";
export default {
  components: { EditReply, like },
  props: ["data", "index"],
  data() {
    return {
      editing: false,
      beforEditReplyBody: "",
    };
  },
  created() {
    this.listenCancel();
  },
  computed: {
    own() {
      return User.own(this.data.user_id);
    },
    reply() {
      return md.parse(this.data.reply);
    },
  },
  methods: {
    destroy() {
      EventBus.$emit("deleteReply", this.index);
    },
    edit() {
      this.editing = true;
      this.beforEditReplyBody = this.data.reply;
    },
    listenCancel() {
      EventBus.$on("cancelEditing", (reply) => {
        this.editing = false;
        if (reply !== this.data.reply) {
          this.data.reply = this.beforEditReplyBody;
          this.beforEditReplyBody = "";
        }
      });
    },
  },
};
</script>

<style></style>