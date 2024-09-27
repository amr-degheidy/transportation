import { defineStore } from "pinia";
import axiosClient from "../axios.js";

export const userStore = defineStore("userStore", {
    state: () => ({
        token: sessionStorage.getItem('TOKEN'),
        data: sessionStorage.getItem('userInfo')
    }),
    getters: {
        getUserToken() {
            return this.token;
        },
    },
    actions: {
        login(userData) {
            return axiosClient.post('/dashboard/login',userData)
                .then(({data}) => {
                    this.data = data.data
                    this.setToken(data.data.token)
                    this.setData(data.data.admin)
                    return data;
                })
        },
        setToken(token) {
            this.token = token;

            if(token) {
                sessionStorage.setItem('TOKEN', token);
            }else{
                sessionStorage.removeItem('TOKEN')
            }
        },
        setData(data) {
            this.data = data;
            if(data) {
                sessionStorage.setItem('userInfo',JSON.stringify(data))
            } else{
                sessionStorage.removeItem('userInfo')
            }
        },
        getName() {
            return JSON.parse(this.data).name
        }

    },
});
