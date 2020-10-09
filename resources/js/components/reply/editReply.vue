<template>
  <div>
    <vue-simplemde v-model="reply.reply"></vue-simplemde>
    <v-card-actions>
      <v-btn>
        <v-icon @click="save" color="green">save</v-icon>
      </v-btn>

      <v-btn @click="cancel">
        <v-icon color="black "> cancel</v-icon>
      </v-btn>
    </v-card-actions>
  </div>
</template>

<script>
export default {
  props: ["reply"],
  methods: {
    cancel(reply) {
      EventBus.$emit("cancelEditing", reply);
    },
    save() {
      axios
        .patch(
          `/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,
          { body: this.reply.reply }
        )
        .then((res) => this.cancel(this.reply.reply));
    },
  },
};
</script>

<style lang="stylus" scoped></style>
