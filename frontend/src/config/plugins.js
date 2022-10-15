
import Vue from 'vue';
import auth                  from '@websanova/vue-auth/src/v2.js';
import driverAuthBearer      from '@websanova/vue-auth/src/drivers/auth/bearer.js';
import driverHttpAxios       from '@websanova/vue-auth/src/drivers/http/axios.1.x.js';
import driverRouterVueRouter from '@websanova/vue-auth/src/drivers/router/vue-router.2.x.js';
import router from '../router/index';
import axios from 'axios';

Vue.use(auth, {
    plugins: {
        http: axios, // Axios
        router: router,
    },
    drivers: {
        auth: driverAuthBearer,
        http: driverHttpAxios, // Axios
        router: driverRouterVueRouter,
    },
    options: {
        authRedirect: {
            name: 'login',
        },
        notFoundRedirect: '/dashboard',
        fetchData: {
            url: process.env.VUE_APP_BACKEND_API_URL+'/merchant/auth',
            method: 'GET',
            enabled: true
        },
        staySignedIn: {
            enabled: true,
            interval: 30
        },
        refreshData: {
            url:process.env.VUE_APP_BACKEND_API_URL+ '/merchant/refresh-token',
            method: 'GET',
            enabled: true,
            interval: 30
        },
        logoutData: {
            redirect: process.env.VUE_APP_BACKEND_API_URL+'/',
        },
    }
});
