import Axios from 'axios'
import router from '../router';
import store from '../store';

const api = Axios.create({
    baseURL: process.env.VUE_APP_BACKEND_API_URL,
    headers: {
      'Accept': 'application/json',
    },
    withCredentials: true,
})

api.interceptors.response.use(undefined, function (error) {
  if (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {
        originalRequest._retry = true;
        store.dispatch('LogOut')
        return router.push('/')
    }
  }
})

export default api