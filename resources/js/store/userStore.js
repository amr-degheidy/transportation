import { defineStore } from "pinia";
import axiosClient from "../axios.js";
import backEndRoutes from "../../backend-routes.json";
export const userStore = defineStore("userStore", {
    state: () => ({
        token: sessionStorage.getItem('TOKEN'),
        info: sessionStorage.getItem('userInfo')
    }),
    getters: {
        getUserToken() {
            return this.token;
        },
        getName() {
            return JSON.parse(this.info).name
        }
    },
    actions: {
        login(userData) {
            return axiosClient.post(backEndRoutes["dashboard.login"],userData)
                .then(({data}) => {
                    this.setToken(data.data.token)
                    this.setInfo(data.data.admin)
                    return data;
                })
        },
        logout(){
            return axiosClient.post(backEndRoutes["dashboard.logout"])
                .then(()=>{
                    this.setToken(null);
                    this.setInfo(null)
                })
            ;
        },
        setToken(token) {
            this.token = token;
            if(token) {
                sessionStorage.setItem('TOKEN', token);
            }else{
                sessionStorage.removeItem('TOKEN')
            }
        },
        setInfo(info) {
            if(info) {
                sessionStorage.setItem('userInfo',JSON.stringify(info))
            } else{
                sessionStorage.removeItem('userInfo')
            }
        },

    },
});
