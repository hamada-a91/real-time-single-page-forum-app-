<template>
  <v-container>
    <v-form @submit.prevent="login">
      <v-text-field
        v-model="form.email"
        label="E-mail"
        required
        type="email"
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        required
      ></v-text-field>

      <v-btn color="blue" class="mr-4" type="submit"> Login </v-btn>
      <router-link to="/signup">
        <v-btn color="blue" class="mr-4"> Sign Up</v-btn>
      </router-link>
    </v-form>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  create() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    login() {
      User.login(this.form);
      //this.$router.push({ name: "forum" });
    },
  },
};
</script>

<style>
</style>