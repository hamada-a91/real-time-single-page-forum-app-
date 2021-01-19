<template>
  <div>
    <v-row align="start">
      <new-suggestment-view
        v-for="(suggestment, index) in content"
        :key="suggestment.id"
        :data="suggestment"
        :index="index"
        v-if="newView"
      >
      </new-suggestment-view>
    </v-row>
  </div>
</template>

<script>
import NewSuggestmentView from "./NewSuggestmentView";
export default {
  components: { NewSuggestmentView },
  props: ["questionSlug"],
  data() {
    return {
      content: null,
      newView: true,
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