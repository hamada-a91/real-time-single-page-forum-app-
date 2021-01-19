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
      <v-spacer></v-spacer>
      <v-btn class="mt-4" color="primary" @click="update">Save</v-btn>
    </v-row>
    <span class="green--text" v-if="updated"> save successfull</span>
  </v-container>
</template>

<script>
export default {
  props: ["data", "questionSlug"],
  data() {
    return {
      form: this.data,
      updated: false,
    };
  },
  methods: {
    update() {
      axios
        .patch(
          `/api/question/${this.questionSlug}/suggestment/${this.data.id}`,
          { date: this.form.date, time: this.form.time }
        )
        .then((res) => (this.updated = true));
    },
  },
};
</script>