import Api from '../../services/api-service';
import { bus } from '../../services/event-bus';

const state = {
    user: null,
};

const mutations = {
    setUser(state, username) {
        state.user = username;
    },

    logout(state, user) {
        state.user = user;
    },
};

const actions = {

    async LogIn({ commit }, user) {
        const loginRes = await Api.post("login", user).catch((err)=> {
            console.log("ERROR", err)
            //check for error message
            if(err){
                bus.$emit("showSnackBar", err.message);
            }
            return {success: false}
        })
        await commit("setUser", loginRes.user);
        return {success: true}
    },
    async LogOut({ commit }) {
        let user = null;
        commit("logout", user);
    },
};

const getters = {
    isAuthenticated: (state) => !!state.user,
    StateUser: (state) => state.user,
    checkPermissions: (state) => permission => {
        return state.user && state.user.permissions && state.user.permissions.find( item => permission === item) ? true : false;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};

// import Vue from 'vue';

// const state = {
//     namespaced: true,
//     user: []
// }

// const getters = {
//     users(state) {
//         return state.user
//     },
//     getUser(state) {
//         return state.user
//     },
//     checkPermissions: (state) => permission => {
//         return state.user && state.user.permissions && state.user.permissions.find( item => permission === item) ? true : false;
//     }
// }

// // mutations
// const mutations = {

//     'SET_USER'(state, payload) {

//         state.user = payload

//     }
// }

// // actions
// const actions = {

//     setUser: ({ commit }) => {
//         console.log('commit' , commit)     
//         return new Promise((resolve, reject) => {   
//         let url = '/user';
//         Vue.prototype.apiRequest(url.url, url.method, () => {})
//             .then(res => {
//                 let authUser = res.data.data;
//                 console.log('auth user from store', authUser)
//                 commit('SET_USER', authUser);
//                 resolve(res);
//             }).catch(err => {
//                 reject(err);
//             })
//         })
//     }

// }

// export default {
//     state, mutations, actions, getters
// }