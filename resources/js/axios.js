import axios from "axios";
import router from "./router/index.js";
import { userStore } from "./store/userStore.js";
const URL = 'http://localhost:8080/api'
const axiosClient = axios.create({
    baseURL: URL
})

axiosClient.interceptors.request.use(config => {
    const user = userStore();

    config.headers.Authorization = 'Bearer ' + user.token
    config.headers.setAccept('application/vnd.api+json');
    config.headers.setContentType('application/vnd.api+json');
    return config;
})

axiosClient.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        const user = userStore();

        user.setToken(null)
        router.push({ name: 'Login'})
    }
    throw error;
})
export default axiosClient;
