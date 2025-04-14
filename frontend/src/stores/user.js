import { defineStore } from 'pinia'
import axiosClient from '@/axiosCustom.js'

const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    loading: false,
    token: localStorage.getItem('token') || null,
    error: null,
  }),
  actions: {
    async fetchUser() {
      this.loading = true
      this.error = null

      try {
        const response = await axiosClient.get('/user')
        this.user = response.data

      } catch (error) {
        console.error('Error fetching user:', error)
        this.error = error.response?.data?.message || 'Failed to fetch user'
      } finally {
        this.loading = false
      }
    },
    setUser(user){
      this.user = user;
    }
  },
})

export default useUserStore
