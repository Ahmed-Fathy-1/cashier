import axios from 'axios';
import { defineStore } from 'pinia';
import { extrnalUrl } from '@/config';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null,
        token: '',
    }),
    getters: {
        user: (state) => state.authUser,
        isAuthenticated: (state) => !!state.token, 
    },
    actions: {
        setAuthorizationHeader() {
            if (this.token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            } else {
                delete axios.defaults.headers.common['Authorization'];
            }
        },
        async login(credentials) {
            try {
                const response = await axios.post(`${extrnalUrl}auth/login`, credentials);
                this.authUser = response.data.data.user; 
                this.token = response.data.data.user.token; 

                console.log('auther' , this.authUser);
                console.log('token' , this.token);

                localStorage.setItem('token', this.token);
                // this.setAuthorizationHeader();

            } catch (error) {
                console.error('Login failed:', error);
                throw error;
            }
        }, 
        async register(credentials) {
            try {
                const response = await axios.post(`${extrnalUrl}auth/register`, credentials);
                this.authUser = response.data.data.user; 
                this.token = response.data.data.user.token; 

                localStorage.setItem('token', this.token);
                this.setAuthorizationHeader();

            } catch (error) {
                console.error('Login failed:', error);
                throw error;
            }
        },
        async getUser() {
            try {
                const response = await axios.get('/api/user', {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.authUser = response.data.data; 

            } catch (error) {
                console.error('Failed to fetch user:', error);
            }
        },
        async logout() {
            try{
                const response = await axios.post(`${extrnalUrl}auth/logout`,{}, {
                    headers:{
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${this.token}`,
                    },
                });
            }
            catch(error){
                console.log(error);
            }
            this.authUser = null;
            this.token = '';
            localStorage.removeItem('token'); 
        },
        
        async initialize() {
            const token = localStorage.getItem('token');
            if (token) {
                this.token = token;
               this.setAuthorizationHeader();
               // await this.getUser();
            }
        },
    },
});
