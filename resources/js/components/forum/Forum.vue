<template>
  <v-container fluid grid-list-md>
    <v-parallax :src="require('../images/123.jpg')" height="800">
      <v-layout row wrap>
        <v-flex xs8>
          <question
            v-for="question in questions"
            :key="question.id"
            :data="question"
            >></question
          ></v-flex
        >
        <v-flex xs4>
          <app-sidebar> </app-sidebar>
        </v-flex>
      </v-layout>
    </v-parallax>
  </v-container>
</template>

<script>
import question from "./question";
import AppSidebar from "./AppSidebar";
import Calender from "./Calender";

export default {
  components: { question, AppSidebar, Calender },
  data() {
    return {
      questions: {},
    };
  },
  created() {
    axios
      .get("/api/question")
      .then((res) => (this.questions = res.data.data))
      .catch((error) => console.log(error.response.data));
    console.log(this.questions);
  },
};
</script>
<style lang="sass" scoped>
 
</style>