<template >
  <v-card
    class="mx-auto"
    rounded="2"
    max-width="57%"
    max-height="40"
    color="error"
  >
    <v-card-text>
      <div class="mt-n2">{{ data.user }} : Disagreed it</div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["data", "index"],
};
</script>

<style lang="stylus" scoped></style>