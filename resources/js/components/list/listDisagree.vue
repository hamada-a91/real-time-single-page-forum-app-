<template >
  <v-card class="mx-auto" height="40" rounded="2" color="#FFCCBC">
    <v-row>
      <div class="mt-4 mx-auto">
        {{ data.disagreeName }}
        <v-icon>clear</v-icon>
      </div>
    </v-row>
  </v-card>
</template>

<script>
export default {
  props: ["data", "index"],
};
</script>

<style lang="stylus" scoped></style>