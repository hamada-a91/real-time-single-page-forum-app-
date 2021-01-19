<template>
  <v-card :color="color" class="mx-1 mb-3" width="163" height="60" outlined>
    <v-card-actions>
      <v-checkbox
        v-model="ok"
        label="Agree it   "
        color="white"
        value="success"
        hide-details
      ></v-checkbox>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      ok: null,
      agreeName: null,
      user_id: User.id(),
    };
  },
  computed: {
    color() {
      return this.ok ? "#69F0AE" : "#E8EAF6";
    },
  },
  methods: {
    agreeIt() {
      if (this.ok) {
        axios
          .post(`/api/agree/${this.data.id}`, {
            agreeName: this.agreeName,
            user_id: this.user_id,
            suggestment_id: this.data.id,
          })
          .then((res) => {
            console.log(res.data.agree);
            EventBus.$emit("newAgree", res.data.agree);
            this.ok = null;
            this.agreeName = null;
          })
          .catch((error) => console.log(error));
      } else {
        axios
          .post(`/api/disagree/${this.data.id}`, {
            disagreeName: this.agreeName,
            user_id: this.user_id,
            suggestment_id: this.data.id,
          })
          .then((res) => {
            console.log(res.data.disagree);
            EventBus.$emit("newDisagree", res.data.disagree);
          })
          .catch((error) => console.log(error));
      }
    },
    listen() {
      EventBus.$on("addition", (name) => {
        this.agreeName = name;
        if (!User.loggedIn()) {
          this.user_id = 2;
        }
        this.agreeIt();
      });
    },
  },
  created() {
    this.listen();
  },
};
</script>