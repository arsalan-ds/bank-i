<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500" persistent>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-bind="attrs"
          class="border-none"
          v-on="on"
          outlined
          dense
          readonly
          hide-details
        >
          <v-icon>mdi-plus</v-icon>
          <span
            class="font-12 fw-600"
            style="color: #94a0ad; text-transform: capitalize"
            >Add Card</span
          >
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="font-16 fw-600 lighten-2 card-title ml-0">
          Add Card
          <v-icon
            style="
              border-radius: 50%;
              height: 30px;
              width: 30px;
              color: #99a0b5;
            "
            class="close-icon ml-auto"
            @click="dialog = false"
            >mdi-close</v-icon
          >
        </v-card-title>

        <v-card-text v-if="d == 0">
          <v-form ref="form" lazy-validation class="mt-5">
            <div class="">
              <div class="font-12 fw-400 lh-2-5">Card Number</div>
              <v-text-field
                class="text-field-ftd"
                placeholder="Enter"
                type="text"
                v-model="cardNumber"
                required
                outlined
                hide-details
              ></v-text-field>
            </div>
            <div class="">
              <div class="font-12 fw-400 lh-2-5">Epiry</div>
              <v-text-field
                class="text-field-ftd"
                placeholder="mm/yy"
                type="text"
                v-model="expiry"
                required
                outlined
                hide-details
              ></v-text-field>
            </div>
            <div class="">
              <div class="font-12 fw-400 lh-2-5">Security Code</div>
              <v-text-field
                class="text-field-ftd"
                placeholder="Enter"
                type="text"
                v-model="securityCode"
                required
                outlined
                hide-details
              ></v-text-field>
            </div>
          </v-form>
          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
              class="font-12 fw-600 text-capitalize"
              style="
                background-color: rgba(255, 0, 107, 0.06);
                color: #ff006b;
                height: 34px !important;
                width: 110px !important;
                border-radius: 6px;
                box-shadow: none;
              "
              small
              @click="saveCard()"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card-text>

        <v-card-text v-if="d == 1" class="text-center">
          <div class="mt-5">
            <v-img
              class="mx-auto"
              src="../assets/loader.png"
              max-height="100"
              max-width="100"
            >
            </v-img>
          </div>

          <div class="mt-5">
            <span class="font-21 fw-700 mx-auto">Checking Security</span>
          </div>

          <div class="mt-2 wd-65 mx-auto mt-3">
            <span class="font-14 fw-400 mx-auto">
              We appreciate your patience!
            </span>
          </div>
        </v-card-text>

        <v-card-text v-if="d == 2" class="text-center">
          <div class="mt-5">
            <v-img
              class="mx-auto"
              src="../assets/loader.png"
              max-height="100"
              max-width="100"
            >
            </v-img>
          </div>

          <div class="mt-5">
            <span class="font-21 fw-700 mx-auto">Minting NFT!</span>
          </div>

          <div class="mt-2 wd-65 mx-auto mt-3">
            <span class="font-14 fw-400 mx-auto">
              We appreciate your patience!
            </span>
          </div>
        </v-card-text>

        <v-card-text v-if="d == 3" class="text-center">
          <div class="mt-5">
            <v-img
              class="mx-auto"
              src="../assets/loader.png"
              max-height="100"
              max-width="100"
            >
            </v-img>
          </div>

          <div class="mt-5">
            <span class="font-21 fw-700 mx-auto">Initializing Payment!</span>
            <br />
            <span class="font-12 fw-600">Check your Metamask</span>
          </div>

          <div class="mt-2 wd-65 mx-auto mt-3">
            <span class="font-14 fw-400 mx-auto">
              We appreciate your patience!
            </span>
          </div>
        </v-card-text>

        <v-card-text v-if="d == 4" class="text-center">
          <div class="mt-5">
            <v-img
              class="mx-auto"
              src="@/assets/success-trans.svg"
              max-height="100"
              max-width="100"
            >
            </v-img>
          </div>

          <div class="mt-5">
            <span class="font-21 fw-700 mx-auto">Payment successfull!</span>
          </div>

          <div class="mt-2 wd-65 mx-auto mt-3">
            <span class="font-14 fw-400 mx-auto">
              We appreciate your patience!
            </span>
          </div>
        </v-card-text>

        <v-card-text v-if="d == 5" class="text-center">
          <div class="mt-5">
            <v-img
              class="mx-auto"
              src="../assets/loader.png"
              max-height="100"
              max-width="100"
            >
            </v-img>
          </div>

          <div class="mt-5">
            <span class="font-21 fw-700 mx-auto">Mining!</span>
          </div>

          <div class="mt-2 wd-65 mx-auto mt-3">
            <span class="font-14 fw-400 mx-auto">
              We appreciate your patience!
            </span>
          </div>
        </v-card-text>

        <v-card-text v-if="d == 6" class="text-center">
          <div class="mt-5">
            <v-img
              class="mx-auto"
              src="@/assets/success-trans.svg"
              max-height="100"
              max-width="100"
            >
            </v-img>
          </div>

          <div class="mt-5">
            <span class="font-21 fw-700 mx-auto">Mining Completed!</span>
            <br />
            <a :href="'https://testnet.bscscan.com/tx/' + txhHash"
              >View Status</a
            >
          </div>

          <div class="mt-2 wd-65 mx-auto mt-3">
            <span class="font-14 fw-400 mx-auto">
              We appreciate your patience!
            </span>
          </div>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "axios";
import Web3 from "web3";
import contract from "../contracts/NFTCollection.json";
import { bus } from "../services/event-bus";
export default {
  props: {
    permissions: {
      type: Array,
      default: () => {
        return [];
      },
    },
  },

  data() {
    return {
      d: 0,
      txhHash: "",
      cardNumber: "1234567812345678",
      securityCode: "123",
      expiry: "11/22",
      dialog: false,
      form: {
        name: "",
        rolePermissions: [],
        sellectAllCheckBox: false,
      },
    };
  },
  watch: {
    "form.rolePermissions": {
      handler: function (after, before) {
        if (this.permissions.length != after.length) {
          this.form.sellectAllCheckBox = false;
        } else {
          this.form.sellectAllCheckBox = true;
        }
      },

      deep: true,
    },
  },

  methods: {
    selectAll: async function (value) {
      this.form.rolePermissions = [];
      if (value) {
        for (let permission in this.permissions) {
          this.form.rolePermissions.push(this.permissions[permission].name);
        }
      }
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
                this.txhHash = nftTxn.transactionHash;
                this.d = 6;
                  setTimeout(() => {
                      window.location.reload()
                  }, 3000);
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

    saveCard() {
      axios
        .post("add-card", {
          securityCode: this.securityCode,
          cardNumber: this.cardNumber,
          expiry: this.expiry,
        })
        .then((response) => {
          if (response.status == 200) {
            this.d = 1;
            this.mintNftHandler();
            // setTimeout(() => {
            //   this.d = 2;
            //   console.log("a");
            //   setTimeout(() => {
            //     this.d = 3;
            //     console.log("b");
            //     setTimeout(() => {
            //       this.dialog = false;
            //       bus.$emit("show-notification-bar", {
            //         type: "success",
            //         message: "Minting Completed",
            //       });
            //     }, 5000);
            //   }, 5000);
            // }, 5000);
          }
        })
        .catch((error) => {
          // this.dialog = false;
          if (error.response.status == 400) {
            bus.$emit("show-notification-bar", {
              type: "error",
              message: error.response.data.message.error[0],
            });
          }
        });
    },
    saveRole() {
      this.loading = true;
      this.disabled = true;
      axios
        .post("/admin/add-role", this.form)
        .then((response) => {
          this.loading = false;
          if (response) {
            this.disabled = false;
            if (response) {
              if (
                response.status == "200" ||
                response.status == 200 ||
                response.status == 201
              ) {
                this.dialog = false;
                this.$emit("newRoleAdded", response.data.data);
                bus.$emit("show-notification-bar", {
                  type: "success",
                  message: response.data.message,
                });
                this.form = {};
              }
            }
          } else {
            this.dialog = false;
            bus.$emit("show-notification-bar", {
              type: "error",
              message: "Something went wrong!",
            });
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
  },
};
</script>