<template>
  <div>
    <v-row align="start">
      <agree
        v-for="(suggestment, index) in content"
        :key="suggestment.id"
        :data="suggestment"
        :index="index"
      >
      </agree>
    </v-row>
  </div>
</template>


<script>
import Agree from "../agree/Agree";
export default {
  components: { Agree },
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