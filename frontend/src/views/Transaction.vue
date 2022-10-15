<template>
  <div>
    <v-form ref="form" lazy-validation @submit.prevent="onSubmit">
      <v-row
        class="pt-10"
        :class="{
          'form ml-4': $vuetify.breakpoint.smAndUp,
          'pa-0 ma-0': $vuetify.breakpoint.smAndDown,
        }"
      >
        <!-- Form -->
        <v-col lg="12" md="12" sm="12" cols="12" class="mt-n6">
          <!-- Loading -->
          <!-- <div v-if="apiLoading">
            <div class="no-data-found-dashboard-container">
              <div>
                <img width="150px" />
              </div>
              <div class="font-18 fw-500">
                <div>
                  <v-progress-linear
                    class="mb-3"
                    color="primary"
                    indeterminate
                    rounded
                    height="3"
                  ></v-progress-linear>
                </div>
                <div class="mt-2 font-12 text-dusk">
                  PLEASE WAIT WHILE LOADING....
                </div>
              </div>
            </div>
          </div> -->
          <div>
            <!-- <v-row no-gutters>
              <v-col cols="12">
                <div class="logo py-10 ml-3">
                  <v-img :src="require('@/assets/pcuniaLogo.svg')"> </v-img>
                </div>
                <div class="logo2 ml-3">
                  <v-img :src="require('@/assets/logo2.svg')"> </v-img>
                </div>
              </v-col>
            </v-row> -->
            <v-card
              elevation="0"
              class="ma-4"
              height="500"
              width="1208"
              rounded="lg"
              style="overflow: scroll"
            >
              <v-card-title>
                <!-- <v-row class="mx-auto my-2">
                  <v-col cols="1">
                    <span class="color-pink f17 fw-700 cursor-pointer">
                      <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                          <v-icon
                            size="20"
                            v-bind="attrs"
                            v-on="on"
                            color="pink"
                            @click="clickOnBack()"
                            >mdi-arrow-left</v-icon
                          >
                        </template>
                        <span>Go Back</span>
                      </v-tooltip>
                    </span>
                  </v-col>
                  <v-col cols="5" sm="5" md="5" lg="5">
                    <span class="f22 color-light-gray fw-700"
                      >Your wallets >
                    </span>
                    <span class="f20 fw-700"> Transactions</span>
                  </v-col>
                  <v-col cols="6" md="6" lg="6">
                    <v-select
                      placeholder="All Transactions"
                      class="float-right"
                      style="width: 200px"
                      dense
                      v-model="transactionType"
                      :items="array"
                      item-text="name"
                      item-value="value"
                      outlined
                      height="2"
                    >
                    </v-select>
                    <v-btn
                      height="43"
                      width="200"
                      class="appPink mr-3 float-right pink-hover btn-radius appBlack--text ff-Medium f15 fw-500"
                      @click="downloadFile()"
                    >
                      <span class="color-white f14 fw-500">
                        <v-icon size="17">mdi-download-outline</v-icon>
                        Download</span
                      >
                    </v-btn>
                  </v-col>
                </v-row> -->
                <span>
                  <v-icon @click="goBack()"> mdi-arrow-left </v-icon>
                </span>
                <span class="font-20 fw-500">Transactions</span>
              </v-card-title>
              <v-card-text
                class="pa-4 mt-n3"
                :class="{ 'mt-10': $vuetify.breakpoint.smAndUp }"
              >
                <v-row class="ml-3 mr-3">
                  <v-col lg="12" md="12" sm="12" cols="12">
                    <v-data-table
                      class="pink-loader"
                      :mobile-breakpoint="0"
                      :headers="headers"
                      :items="items"
                      :loading="loading"
                      loader-height="2"
                      hide-default-footer
                      :items-per-page="itemsPerPage.key"
                      :page="page.key"
                      no-data-text="No Record Found"
                    >
                    </v-data-table>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </div>
        </v-col>
      </v-row>
    </v-form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  components: {},
  data() {
    return {
      cardsDetails: false,
      totalAvailableAmount: "",
      spendableAmount: "",
      cardId: null,
      altCoin: "",
      loading: false,
      searchBox: "",
      item: {},
      tableItem: [],
      total: 0,
      headers: [
        { text: "Date", value: "date", class: "thead-item" },
        { text: "Tranaction Status", value: "status", class: "thead-item" },
        {
          text: "Amount",
          value: "amount",
          class: "thead-item",
        },

        {
          text: "Transaction ID",
          value: "transactionId",
          class: "thead-item",
        },
      ],
      page: {
        key: 1,
      },
      itemsPerPage: {
        key: 5,
      },

      array: [
        {
          name: "All Transaction",
          value: "all",
        },
        {
          name: "Sent",
          value: "send",
        },
        {
          name: "Received",
          value: "received",
        },
      ],
      items: [
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
        {
          date: "2012-10-9",
          amount: "300$",
          status: "RECEIVED",
          transactionId: "73417328468139749",
        },
      ],
      transactionType: "",
    };
  },
  mounted() {
    this.cardId = this.$route.query.cardId;
    console.log(this.cardId);
  },
  methods: {
    goBack() {
      this.$router.push("/dashboard");
    },
  },
};
</script>

<style scoped>
.v-text-field--outlined >>> fieldset {
  border-color: #94a0ad;
  border-radius: 7px;
  font-weight: 900;
  height: 48px !important;
}
.v-data-table::v-deep th {
  font-size: 12px !important;
  font-family: "Noto-Sans-Medium";
}
.v-data-table::v-deep td {
  font-size: 12px !important;
  font-family: "Noto-Sans-Regular";
}
.v-data-table::v-deep tr:hover:not(.v-data-table__expanded__content) {
  background: #f7f9fc !important;
}
.cards {
  border-radius: 21px;
}
.coins {
  height: 30px !important;
  float: right !important;
  margin-bottom: 80px !important;
}
.spanTag {
  display: inline-block;
  width: 100px;
  white-space: nowrap;
  overflow: hidden !important;
  text-overflow: ellipsis;
  cursor: pointer !important;
}
/* .v-data-table::v-deep tr:nth-of-type(odd) {
 background: #F7F9FC !important;

} */
.spendable-style {
  border: 1px solid #e8ebf6 !important;
  border-radius: 15px !important;
  /* color: #3947d6 !important; */
  min-width: 56px !important;
  min-height: 56px !important;
  background: #dddff2 !important;
}
.total-style {
  border: 1px solid #e8ebf6;
  border-radius: 15px;
  color: #565cae;
  min-width: 56px;
  min-height: 56px;
  background: #dddff2;
}
.pagination-xs {
  margin-bottom: 60px !important;
}
.transaction-dropdown {
  font-family: "Noto-Sans-Medium" !important;
  font-size: 12px;
  font-weight: 600 !important;
  border-radius: 4px !important;
  width: 120px !important;
}

.mobile-transaction-dropdown {
  width: 75% !important;
}
.text-border {
  border: 1px solid !important;
  border-radius: 5px !important;
  border-color: #94a0ad !important;
  height: 41px !important;
}
</style>
