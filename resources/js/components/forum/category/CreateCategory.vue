<template>
  <v-container>
    <div class="d-flex flex-column mb-6">
      <v-card class="pa-2" outlined tile>
        <v-form @submit.prevent="submit">
          <v-text-field
            label="Category Name"
            v-model="form.name"
            type="text"
            required
          ></v-text-field>
          <v-btn v-if="editable" depressed type="submit" color="orange">
            Update
          </v-btn>
          <v-btn v-else depressed type="submit" color="teal"> create </v-btn>
        </v-form>
      </v-card>
    </div>

    <v-card class="mt-2">
      <v-toolbar color="indigo" dark>
        <v-toolbar-title>Categories</v-toolbar-title>
      </v-toolbar>
      <v-list>
        <div v-for="(category, index) in categories" :key="category.id">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title> {{ category.name }} </v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
              <v-btn
                icon
                small
                type="submit"
                @click="destroy(category.slug, index)"
              >
                <v-icon color="teal">delete</v-icon>
              </v-btn>
            </v-list-item-action>
            <v-list-item-action>
              <v-btn icon small type="submit" @click="edit(index)">
                <v-icon color="red">edite</v-icon>
              </v-btn>
            </v-list-item-action>
          </v-list-item>
          <v-divider></v-divider>
        </div>
      </v-list>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
      },
      categories: {},
      editable: null,
    };
  },
  created() {
    axios.get("/api/category").then((res) => (this.categories = res.data.data));
  },
  methods: {
    submit() {
      this.editable ? this.update() : this.create();
    },
    update() {
      axios.patch(`/api/category/${this.editable}`, this.form).then((res) => {
        this.categories.unshift(res.data);
        this.form.name = null;
      });
    },
    create() {
      axios.post("/api/category", this.form).then((res) => {
        this.categories.unshift(res.data);
        console.log(this.form);
        this.form.name = null;
      });
    },
    destroy(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then((res) => {
          this.categories.splice(index, 1);
          alert("deleted");
        })
        .catch((error) => console.log(error.response.data));
    },
    edit(index) {
      this.form.name = this.categories[index].name;
      this.editable = this.categories[index].slug;
      this.categories.splice(index, 1);
    },
  },
};
</script>
<style>
</style>