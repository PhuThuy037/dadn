<script setup>
import { reactive, ref } from 'vue'
import axiosClient from '@/axiosCustom.js'
import router from '@/router/index.js'
import { useToast } from 'vue-toast-notification'
import axios from 'axios'
// import useUserStore from '@/stores/user.js'


const toast = useToast()
const data = ref({
  email: '',
  password: '',
})
// const userStore = useUserStore()
const errorMessage = ref('')

async function submit() {
  try {
    // await axios.get('/sanctum/csrf-cookie')
    const res = await axiosClient.post('/login', data.value)

    console.log(res.data.user)
    // userStore.setUser(res.data.user)
    localStorage.setItem('auth_token', res.data.auth_user)
    toast.success('Login successfully', {
      position: 'top',
    })

    await router.push({name: 'home'})
  } catch (error) {
    console.error('Something went wrong', error)
    toast.error(error.response?.data?.message || 'Login failed', {
      position: 'top',
    })
  }
}
</script>

<template>
  <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
    Sign in to your account
  </h2>

  <div v-if="errorMessage" class="mt-4 py-2 px-3 rounded text-white bg-red-400">
    {{ errorMessage }}
  </div>

  <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
    <form @submit.prevent="submit" class="space-y-6">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input
            type="email"
            name="email"
            id="email"
            autocomplete="email"
            required=""
            v-model="data.email"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="  password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input
            type="password"
            name="password"
            id="password"
            autocomplete="current-password"
            required=""
            v-model="data.password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
      </div>

      <div>
        <button
          type="submit"
          class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Sign in
        </button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Not a member?
      {{ ' ' }}
      <RouterLink
        :to="{ name: 'Signup' }"
        class="font-semibold text-indigo-600 hover:text-indigo-500"
      >
        Create an account
      </RouterLink>
    </p>
  </div>
</template>

<style scoped></style>
