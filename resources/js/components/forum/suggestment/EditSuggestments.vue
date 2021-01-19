<template>
  <div>
    <v-col align="start">
      <edit-suggestment
        v-for="(suggestment, index) in content"
        :key="suggestment.id"
        :data="suggestment"
        :index="index"
        :questionSlug="questionSlug"
      >
      </edit-suggestment>
    </v-col>
  </div>
</template>

<script>
import EditSuggestment from "./EditSuggestment";
export default {
  components: { EditSuggestment },
  props: ["questionSlug", "suggestments"],
  data() {
    return {
      content: this.suggestments,
    };
  },
  created() {
    this.listen();
  },
  methods: {
    listen() {
      EventBus.$on("newSuggestment", (suggestment) => {
        console.log(suggestment);
        this.content = this.content || [];
        this.content.unshift(suggestment);
        console.log(this.content);
        this.newView = true;
      });

      EventBus.$on("destroySuggestment", (index) => {
        axios
          .delete(
            `/api/question/${this.questionSlug}/suggestment/${this.content[index].id}`
          )
          .then((res) => {
            this.content.splice(index, 1);
          });
      });
    },
  },
};
</script>