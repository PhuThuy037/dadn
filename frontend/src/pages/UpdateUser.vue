<script setup>
import { ref } from 'vue'

import axiosClient from '@/axiosCustom.js'
import router from '@/router/index.js'
import { useToast } from 'vue-toast-notification'
import useUserStore from "@/stores/user.js";

const userStore = useUserStore()

const userId = userStore.user.id;

console.log(userId)
const toast = useToast()
const data = ref({
  name: '',
  email: '',
  password: '',

})

const errors = ref({
  name: [],
  email: [],
  password: [],
})

async function submit() {
  try {
    const payload = Object.fromEntries(
      Object.entries(data.value).filter(([key, value]) => {
        return value !== '' && value !== null && value !== undefined
      })
    )

    const res = await axiosClient.post(`/user/${userId}/update`, payload)
    toast.success('Update success', {
      position: 'top',
    })

    await router.push('/')
  } catch (error) {
    console.error('Register fail', error)
    toast.success(error, {
      position: 'top',
    })
  }
}


</script>

<template>
  {{data}}
  <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
   Update Your Info
  </h2>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label for="name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
        <div class="mt-2">
          <input
            name="name"
            id="name"
            v-model="data.name"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <p class="text-sm mt-1 text-red-600">
          {{ errors.name ? errors.name[0] : '' }}
        </p>
      </div>
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input
            type="email"
            name="email"
            id="email"
            autocomplete="email"
            v-model="data.email"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <p class="text-sm mt-1 text-red-600">
          {{ errors.email ? errors.email[0] : '' }}
        </p>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input
            type="password"
            name="password"
            id="password"
            v-model="data.password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <p class="text-sm mt-1 text-red-600">
          {{ errors.password ? errors.password[0] : '' }}
        </p>
      </div>

      <div>
<!--        <div class="flex items-center justify-between">-->
<!--          <label for="passwordConfirmation" class="block text-sm/6 font-medium text-gray-900"-->
<!--          >Repeat Password</label-->
<!--          >-->
<!--        </div>-->
<!--        <div class="mt-2">-->
<!--          <input-->
<!--            type="password"-->
<!--            name="password"-->
<!--            id="passwordConfirmation"-->
<!--            v-model="data.password_confirmation"-->
<!--            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"-->
<!--          />-->
<!--        </div>-->
      </div>

      <div>
        <button
          type="submit"
          class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Update
        </button>
      </div>
    </form>


  </div>
</template>

<style scoped></style>
