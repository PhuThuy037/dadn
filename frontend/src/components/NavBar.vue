<script setup>
import { RouterLink, useRoute } from 'vue-router'
// import useUserStore from '@/stores/user.js'
import { computed, onMounted, ref } from 'vue'
import { useToast } from 'vue-toast-notification'
import axiosClient from '@/axiosCustom.js'
import router from '@/router/index.js'

const toat = useToast()

// const userStore = useUserStore()
const isAdmin = ref(true)

// if (userStore.user.role === 'admin') {
//   isAdmin.value = true
// }
const isActiveLink = (routePath) => {
  const route = useRoute()
  return route.path === routePath
}

const logout = async () => {
  try {
    await axiosClient.get('/logout')
    useUserStore.user = null
    router.push({ name: 'Login' })
    toat.success('Logout Successfully', {
      position: 'top',
    })
  } catch (e) {
    console.error(e)
    toat.error('Error logout', {
      position: 'top',
    })
  }
}
</script>
<template>
  <nav class="bg-green-700 border-b border-green-500">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="flex h-20 items-center justify-between">
        <div class="flex flex-1 items-center justify-center md:items-stretch md:justify-start">
          <!-- Logo -->
          <a class="flex flex-shrink-0 items-center mr-4" href="index.html">
            <span class="hidden md:block text-white text-2xl font-bold ml-2">Room</span>
          </a>
          <div class="md:ml-auto">
            <div class="flex space-x-2">
              <RouterLink
                to="/"
                :class="[
                  isActiveLink('/') ? 'bg-green-900' : 'hover:bg-gray-900 hover:text-white',
                  'text-white',
                  'px-3',
                  'py-2',
                  'rounded-md',
                ]"
                >Home</RouterLink
              >
              <RouterLink
                to="/room/add"
                :class="[
                  isActiveLink('/job/all') ? 'bg-green-900' : 'hover:bg-gray-900 hover:text-white',
                  'text-white',
                  'px-3',
                  'py-2',
                  'rounded-md',
                ]"
                >Add Room</RouterLink
              >

              <a
                v-if="true"
                @click="logout"
                :class="[
                  'hover:bg-gray-900 hover:text-white',
                  'text-white',
                  'px-3',
                  'py-2',
                  'rounded-md',
                ]"
                >Logout</a
              >
              <RouterLink
                v-if="false"
                :to="{ name: 'HomeView' }"
                :class="[
                  'hover:bg-gray-900 hover:text-white',
                  'text-white',
                  'px-3',
                  'py-2',
                  'rounded-md',
                ]"
                >Logout</RouterLink
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
