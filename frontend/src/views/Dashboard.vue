<template>
  <v-container class="fill-height parent-container" fluid>
    <v-row>
      <v-col cols="6" class="font-20 fw-500"> My Cards </v-col>
      <v-col cols="6" class="font-20 fw-500">
        <AddCard />
      </v-col>
    </v-row>
    <v-row class="mb-12">
      <v-col
        lg="6"
        md="6"
        sm="12"
        cols="12"
        class="mt-4"
        v-for="item in items"
        :key="item.id"
      >
        <v-card
          :style="'background:#ccc !important;'"
          class="white--text cards"
          width="400"
          height="192"
          @click="viewTransaction(item.id)"
        >
          <div>
            <v-list-item three-line>
              <v-list-item-content class="ml-2 white--text">
                <v-row>
                  <v-col cols="10">
                    <div class="on-heading fw-600 f22 mb-4 ff-Bold">BANKI</div>
                  </v-col>
                  <v-col cols="2">
                    <span> $ </span>
                  </v-col>
                </v-row>
                <br />
                <br />
                <v-row>
                  <v-col cols="12">
                    <p class="mb-1 fw-400 f14 ff-Regular">Account No:</p></v-col
                  >
                </v-row>
                <v-row no-gutters>
                  <v-col cols="12">
                    {{
                      item && item.cardNumber
                        ? item.cardNumber
                        : "**** **** **** ****"
                    }}</v-col
                  >
                </v-row>

                <v-row no-gutters class="mt-2">
                  <v-col cols="6">
                    <p class="mb-1 fw-400 f14 ff-Regular">Expiry:</p></v-col
                  >
                  <v-col cols="6">
                    {{ item && item.expiry ? item.expiry : "-" }}</v-col
                  >
                </v-row>

                <v-row no-gutters class="mt-2">
                  <v-col cols="6">
                    <p class="mb-1 fw-400 f14 ff-Regular">Code:</p></v-col
                  >
                  <v-col cols="6">
                    {{
                      item && item.securityCode ? item.securityCode : "-"
                    }}</v-col
                  >
                </v-row>
              </v-list-item-content>
            </v-list-item>
          </div>
        </v-card>
      </v-col>
      <div v-show="items.length == 0">
        <v-img
          class="mx-auto mt-10"
          :src="require('@/assets/BankI-2.png')"
          max-height="300"
          max-width="300"
          style="opacity:0.4"
        >
        </v-img>
      </div>
    </v-row>
    <div class="con">
      <v-btn
        @click="mintNftHandler()"
        small
        v-show="items.length > 0"
        class="btn btn-primary primary btn-xs floating-btn"
        >Tap To Pay</v-btn
      >
    </div>
  </v-container>
</template>

<script>
import { bus } from "../services/event-bus";
import axios from "axios";
import AddCard from "./AddCard.vue";
import Web3 from "web3";
import contract from "../contracts/NFTCollection.json";

export default {
  name: "Dashboard",
  components: { AddCard },
  data: () => ({
    dialog: false,
    d: 0,
    items: [],
  }),
  methods: {
    open() {
      this.dialog = true;
    },

    getCards() {
      axios
        .get("get-card")
        .then((response) => {
          if (response.status == 200) {
            this.items = response.data.data;
          }
        })
        .catch((error) => {
          this.dialog = false;
          if (error.response.status == 400) {
            bus.$emit("show-notification-bar", {
              type: "error",
              message: error.response.data.message.error[0],
            });
          }
        });
    },
    viewTransaction(item) {
      let idOfCard = item;
      this.$router
        .push({
          path: `/transaction-details`,
          query: { cardId: idOfCard },
        })
        .catch((error) => {
          if (error.name != "NavigationDuplicated") {
            throw error;
          }
        });
    },
    async mintNftHandler() {
      try {
        const { ethereum } = window;

        if (ethereum) {
          // setTimeout(() => {
          //   this.d = 2;
          // }, 5000);
          this.d = 2;
          // Get network provider and web3 instance.
          const web3 = await new Web3(
            Web3.givenProvider || "http://localhost:7545"
          );

          // Use web3 to get the user's accounts.
          const accounts = await web3.eth.getAccounts();

          console.log("Network: ", await web3.eth.net.getId());
          console.log(contract.networks[await web3.eth.net.getId()]);

          const contractAddress =
            contract.networks[await web3.eth.net.getId()].address;
          const abi = contract.abi;

          // Create a contract instance
          const nftContract = new web3.eth.Contract(abi, contractAddress);
          console.log(nftContract);
          this.d = 3;
          console.log("Initialize payment");

          let nftTxn = await nftContract.methods
            .mintNFTs(1, "QmQ3umSp57bqJC6Bh1ZWWoR8JrLFPUzpaWuccz71Gh7jzL")
            .send({
              from: accounts[0],
              value: web3.utils.toWei("0.0001", "ether"),
            })
            .on("receipt", function () {
              console.log("receipt");
              this.d = 3;
            });
          setTimeout(() => {
            this.d = 4;
            setTimeout(() => {
              this.d = 5;

              setTimeout(() => {
                console.log("Mining...please wait");
                console.log("Mined: ", nftTxn.transactionHash);

                bus.$emit("show-notification-bar", {
                  type: "success",
                  message: "Transaction Successfull!",
                });
              }, 5000);
            }, 3000);
          }, 3000);
        } else {
          console.log("Ethereum object does not exist");
        }
      } catch (err) {
        console.log(err);
      }
    },
  },

  mounted() {
    this.getCards();
  },
};
</script>

<style>
.float-right {
  float: right !important;
}
.floating-btn {
  position: fixed;
  bottom: 80px;
  right: 40px;
  z-index: 9;
}
.con {
  display: block;
  position: relative;
}
</style>
