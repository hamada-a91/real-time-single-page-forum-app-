<template>
  <div>
    <v-row align="start">
      <list
        v-for="(suggestment, index) in content"
        :key="suggestment.id"
        :data="suggestment"
        :index="index"
      >
      </list>
    </v-row>
  </div>
</template>
<script>
import list from "../list/list";
export default {
  components: { list },
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