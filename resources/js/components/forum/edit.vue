<template>
  <v-container>
    <v-card class="mx-auto my-auto" width="auto">
      <v-form @submit.prevent="update">
        <v-row>
          <span class="red--text" v-if="errors.title">
            {{ errors.title[0] }}</span
          >
          <v-text-field
            label="Title"
            v-model="form.title"
            type="text"
            required
          ></v-text-field>
          <span class="red--text" v-if="errors.category_id">
            {{ errors.category_id[0] }}</span
          >
          <v-spacer></v-spacer>

          <v-select
            :items="categories"
            item-text="name"
            item-value="id"
            v-model="form.category_id"
            autocomplete
          ></v-select>
        </v-row>
        <div>
          <h4>Discribe</h4>
          <span class="red--text" v-if="errors.body">
            {{ errors.body[0] }}</span
          >
          <v-textarea filled v-model="form.body" name="input-7-4"></v-textarea>
        </div>
        <div class="ui right icon input large">
          <v-text-field
            prepend-icon="mdi-map-marker"
            type="text"
            v-model="form.location"
            label="Location"
          />
        </div>
        <edit-suggestments
          :suggestments="data.suggestments"
          :questionSlug="data.slug"
        ></edit-suggestments>
        <v-card-actions>
          <v-btn icon small type="submit">
            <v-icon color="teal">save</v-icon>
          </v-btn>

          <v-btn icon small @click="cancel">
            <v-icon>cancel</v-icon>
          </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-container>
</template>

<script>
import EditSuggestments from "./suggestment/EditSuggestments";
export default {
  components: { EditSuggestments },
  props: ["data"],
  data() {
    return {
      form: {
        title: null,
        body: null,
      },
      errors: {},
      categories: {},
    };
  },
  methods: {
    cancel() {
      EventBus.$emit("cancelEditing");
    },
    update() {
      axios
        .patch(`/api/question/${this.form.slug}`, this.form)
        .then((res) => this.cancel());
    },
  },
  created() {
    this.form = this.data;
    axios.get("/api/category").then((res) => (this.categories = res.data.data));
  },
};
</script>

<style>
</style>