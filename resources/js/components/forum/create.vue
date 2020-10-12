<template>
  <v-container>
    <v-form @submit.prevent="create">
      <span class="red--text" v-if="errors.title"> {{ errors.title[0] }}</span>
      <v-text-field
        label="Title"
        v-model="form.title"
        type="text"
        required
      ></v-text-field>
      <span class="red--text" v-if="errors.category_id">
        {{ errors.category_id[0] }}</span
      >

      <v-select
        :items="categories"
        item-text="name"
        item-value="id"
        v-model="form.category_id"
        label="Category"
        autocomplete
      ></v-select>
      <div>
        <h4>Discribe</h4>
        <span class="red--text" v-if="errors.body"> {{ errors.body[0] }}</span>
        <v-textarea filled v-model="form.body" name="input-7-4"></v-textarea>
      </div>
      <v-row>
        <v-menu
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="290px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              :value="form.askdate"
              slot="activator"
              label="Due date"
              prepend-icon="date_range"
              v-on="on"
              v-bind="attrs"
            ></v-text-field>
          </template>
          <v-date-picker v-model="form.askdate"></v-date-picker>
        </v-menu>
        <v-menu
          ref="menu"
          :close-on-content-click="false"
          :nudge-right="40"
          :return-value.sync="form.asktime"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="290px"
        >
          <v-spacer></v-spacer>
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="form.asktime"
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
      <div class="ui right icon input large">
        <v-text-field
          prepend-icon="mdi-map-marker"
          type="text"
          placeholder="Enter the address"
          v-model="form.location"
          id="autocomplete"
        />
      </div>
      <v-btn color="green" type="submit">Create</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: null,
        category_id: null,
        body: null,
        asktime: null,
        askdate: null,
        location: null,
      },

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
          this.$router.push(res.data.path);
          console.log(res);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style>
h4 {
  color: purple;
}
@import "~simplemde/dist/simplemde.min.css";
</style>