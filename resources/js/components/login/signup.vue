<template>
  <v-container>
    <v-form @submit.prevent="signup">
      <v-text-field v-model="form.name" label="Name" required></v-text-field>
      <span class="red--text" v-if="errors.name">{{ errors.name[0] }}</span>

      <v-text-field
        v-model="form.email"
        label="E-mail"
        required
        type="email"
      ></v-text-field>
      <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>

      <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        required
      ></v-text-field>
      <span class="red--text" v-if="errors.password">{{
        errors.password[0]
      }}</span>

      <v-text-field
        v-model="form.password_confirmation"
        label="Password Confirmation"
        required
        type="Password"
      ></v-text-field>
      <span class="red--text" v-if="errors.password">{{
        errors.password[0]
      }}</span>

      <div>
        <v-btn color="blue" class="mr-4" type="submit"> Sign UP </v-btn>

        <router-link to="/login">
          <v-btn color="blue" class="mr-4" text> Log in</v-btn>
        </router-link>
      </div>
    </v-form>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      errors: {},
    };
  },
  create() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    signup() {
      axios
        .post("/api/auth/signup", this.form)
        .then(
          (res) => User.responseAfterLogin(res),
          this.$router.push({ name: "forum" })
        )
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>
<style>
</style>