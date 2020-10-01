<template>
  <div v-if="question">
    <edit :data="question" v-if="editing"></edit>
    <div v-else>
      <show-question :data="question" v-if="question"></show-question>
    </div>
  </div>
</template>
<script>
import ShowQuestion from "./ShowQuestion";
import edit from "./edit";

export default {
  components: { ShowQuestion, edit },
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