<template>
  <v-sheet height="100%" class="main-sheet" color="#FFFFFF">
    <v-row no-gutters>
      <v-col align="center" class="mx-auto my-auto pb-5" cols="12" lg="6">
        <!-- <div class="qbd-logo mt-9">
          <v-img
            width="115px"
            :src="require('@/assets/logo.svg')"
          ></v-img>
        </div> -->
        <div class="login-form-container">
          <v-card
            class="login-card"
            style="margin-top: 50px"
            width="530"
            height="400"
            elevation="0"
            color="#FFFFFF"
          >
            <div class="header-info mt-10">
              <div class="font-24 fw-700">Login</div>
              <div class="font-13 fw-500 mt-1">
                <!-- Enter your credentials to access your account -->
              </div>
            </div>
            <v-form ref="form" lazy-validation class="mt-5">
              <div v-if="!(currentAccount || setCurrentAccount)">
                <v-btn
                  class="login-form-btn text-capitalize mt-15"
                  small
                  :loading="loading"
                  @click="connectWalletHandler()"
                >
                  Connect Your Wallet
                </v-btn>
              </div>
              <template v-else>
                <v-btn
                  class="login-form-btn text-capitalize mt-15"
                  small
                  :loading="loading"
                  @click="login"
                >
                  Login To BankI
                </v-btn>
              </template>
            </v-form>
          </v-card>
        </div>
      </v-col>
    </v-row>
  </v-sheet>
</template>

<script>
import { bus } from "../services/event-bus";
import axios from "axios";
export default {
  name: "Login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      remember: false,
      ShowError: false,
      currentAccount: false,
      setCurrentAccount: false,
      errors: {},
      loading: false,
      canBeDisable: false,
    };
  },
  mounted() {
    if (this.$route.query.verified) {
      this.login();
    }
    this.checkWalletIsConnected();
  },

  methods: {
    async checkWalletIsConnected() {
      const { ethereum } = window;

      if (!ethereum) {
        console.log("Make sure you have Metamask installed!");
        return;
      } else {
        console.log("Wallet exists! We're ready to go!");
      }

      const accounts = await ethereum.request({ method: "eth_accounts" });

      if (accounts.length !== 0) {
        const account = accounts[0];
        console.log("Found an authorized account: ", account);
        this.currentAccount = account;
      } else {
        console.log("No authorized account found");
      }
    },

    async connectWalletHandler() {
      const { ethereum } = window;

      if (!ethereum) {
        alert("Please install Metamask!");
      }

      try {
        const accounts = await ethereum.request({
          method: "eth_requestAccounts",
        });
        console.log("Found an account! Address: ", accounts[0]);
        this.setCurrentAccount = accounts[0];
        console.log(this.setCurrentAccount);
      } catch (err) {
        console.log(err);
      }
    },
    login() {
      this.loading = true;
      this.$auth
        .login({
          url: "/sign-in",
          method: "get",
          fetchUser: false,
        })
        .then((response) => {
          if (response.status == 200) {
            this.loading = false;
            this.$auth.fetch();
            this.$router.push("/dashboard");
          }
        })
        .catch((err) => {
          this.loading = false;
          if (err.response.status == 400) {
            bus.$emit("show-notification-bar", {
              type: "error",
              message: err.response.data.message,
            });
          }
          if (err.response.status == 422) {
            bus.$emit("show-notification-bar", {
              type: "error",
              message: err.response.data.message.error[0],
            });
          }
        });
    },
  },
};
</script>
