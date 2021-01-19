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
      <v-btn class="mb-14" text color="pink">{{ replyCount }} Reply</v-btn>
    </v-card-title>

    <v-card
      class="mb-4 d-flex align-start justify-start pa-4 ml-4 mr-4"
      max-width="full"
      min-height="76"
      outlined
      color="#E3F2FD"
    >
      <div class=".text-lg-h6">{{ data.body }}</div>
    </v-card>
    <suggestments :questionSlug="data.slug"></suggestments>
    <agrees :questionSlug="data.slug"></agrees>

    <v-row>
      <div class="mx-1 ml-4 d-flex align-center">
        <v-text-field
          label="Name"
          v-model="nameSuggestmentOwner"
          class="shrink"
        ></v-text-field>
        <div class="mt-n6 ml-3">
          <v-btn max-width="90px" color="primary" @click="addition">
            Addition
          </v-btn>
        </div>
      </div>
    </v-row>
    <v-divider></v-divider>

    <lists :questionSlug="data.slug"></lists>

    <v-divider></v-divider>

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
import lists from "../list/lists";

import Suggestments from "./suggestment/Suggestments";
import Agrees from "./agree/Agrees";

export default {
  components: { listAgree, lists, listDisagree, Agrees, Suggestments },
  data() {
    return {
      own: User.own(this.data.user_id),
      loader: null,
      loading2: false,
      agreed: this.data.agreed,
      disagreed: this.data.disagreed,
      agrees: null, //array for agrees component
      disagrees: null, //array for disagrees component
      replyCount: this.data.reply_count,
      lengtha: null,
      lengthd: null,
      nameSuggestmentOwner: "",
    };
  },
  created() {
    this.getAgree();
    this.getDisagree();
    EventBus.$on("newReply", () => {
      this.replyCount++;
    });
    EventBus.$on("deleteReply", () => {
      this.replyCount--;
    });
  },
  props: ["data"],
  computed: {
    body() {
      return md.parse(this.data.body);
    },
    /* lengtha() {
      if (this.agrees.length !== 0) {
        return this.agrees.length;
      }
    },
    lengthd() {
      if (this.disagrees.length != 0 && this.disagrees < 1) {
        //return this.disagrees.length;
      }
    },*/
    disable() {
      return this.agreed ? true : false;
    },
    disableD() {
      return this.disagreed ? true : false;
    },
    unshift() {},
  },
  methods: {
    addition() {
      EventBus.$emit("addition", this.nameSuggestmentOwner);
    },
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
        this.lengtha = res.data.data.length;
        console.log(this.agrees);
      });
    },
    getDisagree() {
      axios
        .get(`/api/question/${this.data.slug}/disagree`)
        .then((res) => {
          this.disagrees = res.data.data;
          this.lengthd = res.data.data.length;

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
            this.lengtha++;

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
            this.lengthd++;

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
          this.lengthd--;
        })
        .catch((error) => console.log(error.response.data));
    },
    deleteAgree() {
      axios
        .delete(`/api/agree/${this.data.slug}`)
        .then((res) => {
          console.log("deletedagree");
          this.lengtha--;
        })
        .catch((error) => console.log(error.response.data));
    },
    findElement(agree) {
      return agree.id === User.id();
    },
  },
};
</script>
