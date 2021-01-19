<template >
  <v-row>
    <v-menu v-model="showMenu" absolute offset-x>
      <template v-slot:activator="{ on, attrs }">
        <v-card
          class="mx-auto"
          height="40"
          width="163"
          v-bind="attrs"
          v-on="on"
          rounded="2"
          color="#69F0AE"
        >
          <v-row>
            <div class="mt-4 mx-auto">
              {{ data.agreeName }}
              <v-icon>check</v-icon>
            </div>
          </v-row>
        </v-card>
      </template>

      <v-list>
        <v-list-item>
          <v-list-item-title>
            <v-list-item-action
              style="cursor: pointer"
              aria-grabbed=""
              @click="deleteIt"
            >
              delete
            </v-list-item-action>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-row>
</template>

<script>
export default {
  props: ["data", "index"],
  data() {
    return {
      showMenu: false,
    };
  },
  methods: {
    deleteIt() {
      console.log("delete");
      axios.delete(`/api/agree/${this.data.agreeName}`).then((res) => {
        console.log("delete IT");
        EventBus.$emit("deleteAgree", this.data.agreeName);
        this.deleteconverse();
      });
    },
    deleteconverse() {
      axios
        .delete(`/api/disagree/${this.data.agreeName}`)
        .then((res) => {
          console.log("delete disagree IT");
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style lang="stylus" scoped></style>