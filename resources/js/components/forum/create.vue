<template>
  <v-container>
    <v-form @submit.prevent="create">
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
          label="Category"
          autocomplete
        ></v-select>
      </v-row>
      <div>
        <h4>Discribe</h4>
        <span class="red--text" v-if="errors.body"> {{ errors.body[0] }}</span>
        <v-textarea filled v-model="form.body" name="input-7-4"></v-textarea>
      </div>
      <div class="ui right icon input large">
        <v-text-field
          prepend-icon="mdi-map-marker"
          type="text"
          placeholder="Enter the address"
          v-model="form.location"
          id="autocomplete"
        />
      </div>
      <new-suggestment-views :questionSlug="slug1"></new-suggestment-views>

      <v-btn v-if="!createdAsk" color="secondary" type="submit"
        >Add Time & Date</v-btn
      >
      <new-suggestment
        v-if="createdAsk"
        :questionSlug="slug1"
        :path="path"
      ></new-suggestment>
    </v-form>
  </v-container>
</template>

<script>
import NewSuggestment from "./suggestment/NewSuggestment";
import NewSuggestmentViews from "./suggestment/NewSuggestmentViews";

export default {
  components: { NewSuggestment, NewSuggestmentViews },
  data() {
    return {
      form: {
        title: null,
        category_id: null,
        body: null,
        asktime: "10:10",
        askdate: "2021-07-11",
        location: null,
      },
      createdAsk: false,
      slug1: null,
      path: null,

      categories: {},
      errors: {},
    };
  },
  mounted() {
    new google.maps.places.Autocomplete(
      document.getElementById("autocomplete"),
      {
        bounds: new google.maps.LatLngBounds(
          new google.maps.LatLng(51.3, 12.0)
        ),
      }
    );
  },
  created() {
    axios.get("/api/category").then((res) => (this.categories = res.data.data));
  },
  methods: {
    create() {
      console.log(this.form);
      axios
        .post("/api/question", this.form)
        .then((res) => {
          // this.$router.push(res.data.path);
          this.slug1 = res.data.slug;
          this.path = res.data.path;
          console.log(res.data.slug);
          this.createdAsk = true;
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style>
h4 {
  color: cornflowerblue;
}
@import "~simplemde/dist/simplemde.min.css";
</style>