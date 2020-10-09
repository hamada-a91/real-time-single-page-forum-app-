<template>
  <v-row
    class="mr-16 align-self-center mx-auto"
    color="#E3F2FD"
    align-self="center"
  >
    <v-text-field
      class="my-3"
      placeholder="add Comment"
      filled
      rounded
      dense
      v-model="body"
    ></v-text-field>
    <v-btn small class="mx-2 mt-3" fab dark color="indigo" @click="submit">
      <v-icon dark> mdi-reply </v-icon>
    </v-btn>
  </v-row>
</template>

<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      body: null,
    };
  },
  methods: {
    submit() {
      axios
        .post(`/api/question/${this.questionSlug}/reply`, { body: this.body })
        .then((res) => {
          EventBus.$emit("newReply", res.data.reply);
          this.body = "";
          window.scrollTo(0, 0);
        });
    },
  },
};
</script>

<style></style>