<template>
  <v-card :color="color" class="mx-1 mb-3" width="163" height="auto" outlined>
    <list-agree
      v-for="(agree, index) in sort"
      :key="agree.id"
      :data="agree"
      :index="index"
    >
    </list-agree>
    <list-disagree
      v-for="(disagree, index) in sort2"
      :key="disagree.id"
      :data="disagree"
      :index="index"
    >
    </list-disagree>
  </v-card>
</template>
<script>
import listAgree from "./listAgree";
import listDisagree from "./listDisagree";
export default {
  components: { listAgree, listDisagree },
  props: ["data"],
  data() {
    return {
      agrees: this.data.agrees,
      disagrees: this.data.disagrees,
      //  bothAD: prototype.push.apply(this.agrees, this.disagrees),
    };
  },
  created() {
    this.listen();
  },

  computed: {
    color() {
      return this.agree ? "#69F0AE" : "#FFCCBC";
    },
    sort() {
      return this.agrees.sort((a, b) => (a.agreeName > b.agreeName ? 1 : -1));
    },
    sort2() {
      return this.disagrees.sort((a, b) =>
        a.agreeName > b.agreeName ? 1 : -1
      );
    },
  },
  methods: {
    listen() {
      EventBus.$on("newAgree", (newAgree) => {
        if (newAgree.suggestemnt_id == this.data.id) {
          this.agrees.unshift(newAgree);
        } else {
        }
      });
      EventBus.$on("newDisagree", (newDisagree) => {
        console.log(newDisagree);
        if (newDisagree.suggestemnt_id == this.data.id) {
          console.log("success");

          this.disagrees.unshift(newDisagree);
        } else {
        }
      });
      EventBus.$on("deleteAgree", (name) => {
        for (var i = 0; i < this.agrees.length; i++) {
          if (this.agrees[i].agreeName === name) {
            this.agrees.splice(i, 1);
            i--;
          }
        }
        for (var i = 0; i < this.disagrees.length; i++) {
          if (this.disagrees[i].disagreeName === name) {
            this.disagrees.splice(i, 1);
            i--;
          }
        }
      });
    },
  },
  deleteWhere() {},
};
</script>