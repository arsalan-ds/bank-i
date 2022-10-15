<template>
  <v-card width="100%">
    <v-footer class="sticky-footer" v-bind="localAttrs" :padless="padless">
      <v-card flat tile width="100%" style="background-color:#673ab6 !important" class="text-center">
        <v-card-text>
          <v-btn v-for="icon in icons" :key="icon" class="mx-4" icon style="color:white !important " >
            <v-icon size="24px">
              {{ icon }}
            </v-icon>
          </v-btn>
        </v-card-text>
      </v-card>
    </v-footer>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    icons: ["mdi-home", "mdi-email", "mdi-calendar", "mdi-delete"],
    items: ["default", "absolute", "fixed"],
    padless: false,
    variant: "default",
  }),
  computed: {
    localAttrs() {
      const attrs = {};

      if (this.variant === "default") {
        attrs.absolute = false;
        attrs.fixed = false;
      } else {
        attrs[this.variant] = true;
      }
      return attrs;
    },
  },
};
</script>
<style scoped>
.sticky-footer{
   position: fixed;
    bottom: -6px;
    left: -16px;
    right: -16px;
}
</style>