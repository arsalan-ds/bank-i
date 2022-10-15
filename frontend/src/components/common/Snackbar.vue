<template >
  <div>
    <v-snackbar
      v-model="showSnackbar"
      top
      right
      :elevation="0"
      color="#04405A"
      class="snack"
      :class="'mt-12 snack-type-' + type"
      :timeout="indeterminate ? '-1' : '2500'"
    >
      <div class="notification-content">
        <div class="notification-icon" :class="type">
          <v-icon v-if="type == 'success'">mdi-check-circle</v-icon>
          <v-icon v-if="type == 'error' || type == 'warning'"
            >mdi-close-circle</v-icon
          >
          <v-icon v-if="type == 'info'">mdi-information</v-icon>
        </div>

        <div class="notification-message text-capitalize">
          {{ message }}
        </div>
      </div>
      <template v-slot:action="{ attrs }">
        <a
          class="close-notification-button"
          v-bind="attrs"
          @click="changeValue"
        >
          <v-icon color="black">mdi-close</v-icon>
        </a>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
/**
 * Description: Vuetify snackbar designed according to application theme and called everytime using root emits
 * throughout the application.
 *
 * how to use: paste it to your component:
 *
 */
import { bus } from "../../services/event-bus";
export default {
  name: "snackbar",
  props: ["vmodel", "errorMessage"],
  data() {
    return {
      showSnackbar: false,
      message: "",
      type: "info",
      indeterminate: false,
    };
  },
  mounted() {
    bus.$on("show-notification-bar", (data) => {
      this.type = data.type;
      this.message = data.message;
      this.showSnackbar = true;
      this.indeterminate = data.indeterminate ? true : false;
    });
  },
  methods: {
    changeValue() {
      this.showSnackbar = false;
    },
  },
};
</script>