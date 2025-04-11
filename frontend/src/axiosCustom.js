import axios from 'axios'
import router from '@/router/index.js'

import { useToast } from 'vue-toast-notification'
const toast = useToast()
const axiosClient = axios.create({
  baseURL: import.meta.env.VITE_BASE_URL,
  // withCredentials: true,
  // withXSRFToken: true,
})

axiosClient.interceptors.request.use((config) => {
  // let token = localStorage.getItem('auth_token')

  // if (token) {
  //   token = decodeURIComponent(token)
  //   console.log(token)
  //   config.headers.Authorization = `Bearer ${token}`
  // }

  return config
})
axiosClient.interceptors.response.use(
  (response) => {
    return response
  },
  (error) => {
    if (error.response && error.response.status === 401) {
      console.log(error)
      router.push('/login')
    }

    throw error
  },
)

export default axiosClient
