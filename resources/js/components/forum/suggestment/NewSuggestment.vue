<template>
  <v-container>
    <v-row>
      <v-menu
        transition="scale-transition"
        offset-y
        max-width="290px"
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            :value="form.date"
            slot="activator"
            label="Due date"
            prepend-icon="date_range"
            v-on="on"
            v-bind="attrs"
          ></v-text-field>
        </template>
        <v-date-picker v-model="form.date"></v-date-picker>
      </v-menu>
      <v-menu
        ref="menu"
        :close-on-content-click="false"
        :nudge-right="40"
        :return-value.sync="form.time"
        transition="scale-transition"
        offset-y
        max-width="290px"
        min-width="290px"
      >
        <v-spacer></v-spacer>
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="form.time"
            label="Picker in menu"
            prepend-icon="mdi-clock"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-time-picker
          v-model="form.time"
          full-width
          @click:minute="$refs.menu.save(form.time)"
        ></v-time-picker>
      </v-menu>
    </v-row>
    <div>
      <v-btn color="green" @click="submit2">Create</v-btn>
      <v-btn color="blue" @click="submit">Add Another Suggestion</v-btn>
    </div>
  </v-container>
</template>
<script>
export default {
  props: ["questionSlug", "path"],
  data() {
    return {
      form: {
        date: null,
        time: null,
      },
    };
  },
  methods: {
    submit() {
      axios
        .post(`/api/question/${this.questionSlug}/suggestment`, this.form)
        .then((res) => {
          console.log(res.data);
          EventBus.$emit("newSuggestment", res.data.suggestment);
          this.form.date = null;
          this.form.time = null;
          window.scrollTo(800, 800);
        })
        .catch((error) => console.log(error.response.data));
      console.log("clickcreate");
    },
    submit2() {
      if (this.form.date === "" || this.form.time === "") {
        this.$router.push(this.path);
      } else {
        axios
          .post(`/api/question/${this.questionSlug}/suggestment`, this.form)
          .then((res) => {
            console.log(this.path);
            this.$router.push(this.path);
          })
          .catch((error) => console.log(error.response.data));
      }
    },
  },
};
</script>
