<template>
  <v-parallax :src="require('../images/1233.jpg')" height="auto">
    <div v-if="question">
      <edit :data="question" v-if="editing"></edit>
      <v-card
        class="d-flex justify-end mb-2 align-self-center align-center mx-auto"
        max-width="70%"
        v-else
      >
        <v-col align-self="center">
          <show-question :data="question" v-if="question"></show-question>
          <new-reply :questionSlug="question.slug"></new-reply>
        </v-col>
      </v-card>
      <v-container class="">
        <div max-width="70%" class="mx-auto">
          <replies :question="question" :slugq="question.slug"></replies>
        </div>
        <div></div>
      </v-container>
    </div>
  </v-parallax>
</template>
<script>
import ShowQuestion from "./ShowQuestion";
import edit from "./edit";
import Replies from "../reply/replies";
import NewReply from "../reply/newReply";

export default {
  components: { ShowQuestion, edit, Replies, NewReply },
  data() {
    return {
      question: null,
      editing: false,
    };
  },
  created() {
    this.getQuestion();
    this.listen();
  },
  methods: {
    listen() {
      EventBus.$on("startEditing", () => {
        this.editing = true;
        console.log(this.editing);
      });
      EventBus.$on("cancelEditing", () => {
        this.editing = false;
      });
    },
    getQuestion() {
      axios
        .get(`/api/question/${this.$route.params.slug}`)
        .then((res) => (this.question = res.data.data));
    },
  },
};
</script>
<style>
</style>