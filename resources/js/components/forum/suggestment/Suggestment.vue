<template>
  <v-card color="#E8EAF6" class="mx-1 mb-3" width="163" outlined>
    <v-sheet rounded elevation="4">
      <div class="blue pa-3">
        <h5>{{ format.slice(0, 9) }}</h5>
      </div>
      <div class="light-blue lighten-3 pa-3">
        <h5>{{ format.slice(9) }}</h5>
      </div>
    </v-sheet>
    <v-list-item three-line>
      <v-list-item-content>
        <v-row class="ml-3">
          <v-icon class="mt-n2" color="pink"> mdi-clock </v-icon>

          <h3 class="color-pink">{{ data.time.slice(0, 5) }}</h3>
        </v-row>
      </v-list-item-content>
    </v-list-item>
  </v-card>
</template>
<script>
export default {
  props: ["data", "index"],
  data() {
    return {
      picker: new Date(this.data.date).toISOString().substr(0, 10),
    };
  },
  computed: {
    format() {
      var options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
      };
      var today = new Date(this.data.date);
      return today.toLocaleDateString("en-US", options);
    },
  },
  methods: {
    destroy() {
      EventBus.$emit("destroySuggestment", this.index);
    },
  },
};
</script>
<style>
h3 {
  color: palevioletred;
}
h5 {
  color: white;
}
@import "~simplemde/dist/simplemde.min.css";
</style>