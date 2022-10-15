import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    accessToken: null,
    refreshToken: null,
    APIData: "",
    loggedIn: false
  },

  mutations: {
    updateStorage(state, { access, refresh }) {
      state.accessToken = access;
      state.refreshToken = refresh;
    },
    destroyToken(state) {
      state.accessToken = null;
      state.refreshToken = null;
    },
    loginAttempt(state, payload) { //<<<<<<<<<<<<<<HERE
      state.loggedIn = payload
    }

  },

  plugins: [createPersistedState()]

});
