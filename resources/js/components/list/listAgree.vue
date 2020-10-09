<template >
  <v-card
    class="mx-auto"
    rounded="2"
    max-width="57%"
    max-height="40"
    color="#69F0AE"
  >
    <v-card-text>
      <div class="mt-n2">{{ data.user }} : agreed it</div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["data", "index"],
};
</script>

<style lang="stylus" scoped></style>