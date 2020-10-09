<template>
  <v-card class="mx-auto my-1" color="white">
    <v-card-title>
      <div>
        <div class="headline">
          {{ data.title }}
        </div>
        <v-divider></v-divider>
        <label>{{ data.user }} : </label>
        <span class="grey--text"> {{ data.created_at }}</span>
      </div>
      <v-spacer></v-spacer>
      <v-btn class="mb-14" text color="pink"
        >{{ data.reply_count }} Reply</v-btn
      >
    </v-card-title>
    <v-card-text aria-setsize="15">
      <v-textarea
        filled
        name="input-7-4"
        :value="data.body"
        disabled
      ></v-textarea
    ></v-card-text>
    <v-row class="ml-4">
      <v-chip class="ma-2" color="cyan" label text-color="white">
        <v-icon left> mdi-calendar </v-icon>
        {{ data.askdate }}
      </v-chip>
      <v-chip class="ma-2" color="pink" label text-color="white">
        <v-icon left> mdi-clock </v-icon>
        {{ data.asktime }}
      </v-chip>
      <v-spacer></v-spacer>
      <v-col class="mt-n7">
        <h3>Please choise</h3>
        <v-row>
          <v-btn
            max-width="90px"
            :loading="loading2"
            :disabled="disable"
            color="success"
            @click="agreeIt"
          >
            Agree
          </v-btn>
          <v-btn
            max-width="90px"
            :loading="loading2"
            :disabled="disableD"
            color="error"
            @click="disagreeIt"
          >
            Disagree
          </v-btn>
        </v-row>
      </v-col>
    </v-row>

    <v-divider></v-divider>
    <div>
      <listAgree
        v-for="(agree, index) in agrees"
        :key="agree.id"
        :data="agree"
        :index="index"
      ></listAgree>
      <listDisagree
        v-for="(disagree, index) in disagrees"
        :key="disagree.id"
        :data="disagree"
        :index="index"
      ></listDisagree>
      <v-row class="mx-auto my-auto justify-center">
        <v-chip class="ma-2" color="success" outlined>
          <v-icon left> thumb_up </v-icon>
          {{ agrees.length }} Agrees
        </v-chip>
        <v-chip class="ma-2" color="error" outlined>
          <v-icon left> thumb_down </v-icon>
          {{ disagrees.length }} Disagrees
        </v-chip>
      </v-row>
    </div>

    <v-divider></v-divider>

    <v-row class="ml-4">
      <p weight="400">Link for sharing:</p>
      <p weight="400" class="grey--text">
        http://127.0.0.1:8000/question/{{ data.slug }}
      </p>
    </v-row>
    <v-card-actions v-if="own">
      <v-btn icon small @click="edit">
        <v-icon color="orange">edit</v-icon>
      </v-btn>
      <v-btn icon small @click="destroy">
        <v-icon color="red">delete</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import listAgree from "../list/listAgree";
import listDisagree from "../list/listDisagree";

export default {
  components: { listAgree, listDisagree },
  data() {
    return {
      own: User.own(this.data.user_id),
      loader: null,
      loading2: false,
      agreed: this.data.agreed,
      disagreed: this.data.disagreed,
      agrees: null, //array for agrees component
      disagrees: null, //array for disagrees component
    };
  },
  created() {
    this.getAgree();
    this.getDisagree();
  },
  props: ["data"],
  computed: {
    body() {
      return md.parse(this.data.body);
    },
    disable() {
      return this.agreed ? true : false;
    },
    disableD() {
      return this.disagreed ? true : false;
    },
    unshift() {},
  },
  methods: {
    destroy() {
      axios
        .delete(`/api/question/${this.data.slug}`)
        .then((res) => this.$router.push("/forum"), alert("succese"))
        .catch((error) => console.log(error.response.data));
    },
    edit() {
      EventBus.$emit("startEditing");
    },
    getAgree() {
      axios.get(`/api/question/${this.data.slug}/agree`).then((res) => {
        this.agrees = res.data.data;
        console.log(this.agrees);
      });
    },
    getDisagree() {
      axios
        .get(`/api/question/${this.data.slug}/disagree`)
        .then((res) => {
          this.disagrees = res.data.data;
          console.log(res);
        })
        .catch((error) => console.log(error.response.data));
    },
    //*******methods für Agree und disagree */
    agreeIt() {
      if (User.loggedIn()) {
        axios
          .post(`/api/agree/${this.data.slug}`)
          .then((res) => {
            console.log(res.data.agree);
            this.agrees.unshift(res.data.agree);
            var indexid = this.disagrees.find((agree) => agree.user_id == "1");
            this.disagrees.splice(indexid, 1);

            this.deleteDisAgree();
            this.agreed = !this.agreed;
            this.disagreed = !this.disagreed;
          })
          .catch((error) => console.log(error.response.data));
        var indexid = this.disagrees.find((agree) => agree.user_id == "1");
        console.log(indexid);
      }
    },
    disagreeIt() {
      if (User.loggedIn()) {
        axios
          .post(`/api/disagree/${this.data.slug}`)
          .then((res) => {
            console.log(res.data.disagree);
            this.disagrees.unshift(res.data.disagree);
            var indexid = this.agrees.find((agree) => agree.user_id == "1");
            this.agrees.splice(indexid, 1);
            this.deleteAgree();
            this.disagreed = !this.disagreed;
            this.agreed = !this.agreed;
          })
          .catch((error) => console.log(error.response.data));
      }
    },
    deleteDisAgree() {
      axios
        .delete(`/api/disagree/${this.data.slug}`)
        .then((res) => {
          console.log("deletedDisagree");
        })
        .catch((error) => console.log(error.response.data));
    },
    deleteAgree() {
      axios
        .delete(`/api/agree/${this.data.slug}`)
        .then((res) => {
          console.log("deletedagree");
        })
        .catch((error) => console.log(error.response.data));
    },
    findElement(agree) {
      return agree.id === User.id();
    },
  },
};
</script>