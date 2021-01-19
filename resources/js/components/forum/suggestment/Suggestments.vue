<template>
  <div>
    <v-row align="start">
      <suggestment
        v-for="(suggestment, index) in content"
        :key="suggestment.id"
        :data="suggestment"
        :index="index"
      >
      </suggestment>
    </v-row>
  </div>
</template>
<script>
import Suggestment from "./Suggestment";
export default {
  components: { Suggestment },
  props: ["questionSlug"],
  data() {
    return {
      content: null,
    };
  },
  created() {
    axios.get(`/api/question/${this.questionSlug}/suggestment/`).then((res) => {
      this.content = res.data.data;
      console.log(res.data);
    });
  },
};
</script>