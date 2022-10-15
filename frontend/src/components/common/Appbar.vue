<template>
  <v-card height="100vh" width="100%" style="overflow: scroll">
    <v-app-bar color="deep-purple" dark>
      <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

      <v-toolbar-title>BANKI</v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" absolute temporary>
      <v-list nav dense>
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Account</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-main>
      <v-sheet style="" color="" class="">
        <router-view />
      </v-sheet>
      <div class="footer">
        <Footer />
      </div>
    </v-main>
  </v-card>
</template>
<script>
import Footer from "../common/footer.vue";
export default {
  components: { Footer },
  data: () => ({
    drawer: false,
    group: null,
  }),
};
</script>
<style>
  .footer{
    position: absolute !important;
    width: 100% !important;
  }
</style>