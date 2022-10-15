<template>
  <v-app>
    <snackbar />
    <router-view />
  </v-app>
</template>

<script>
import Snackbar from "./components/common/Snackbar.vue";

export default {
  components: { Snackbar },
  name: "App",
  data: () => ({}),
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Inter&display=swap");
</style>
