<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axiosClient from '@/axiosCustom'
import TEMP from "@/components/Devices/TEMP.vue";
import {useToast} from "vue-toast-notification";
import LedDevice from "@/components/Devices/LedDevice.vue";
import HUMIDITY from "@/components/Devices/HUMIDITY.vue";
import RelayDevice from "@/components/Devices/RelayDevice.vue";
import FanDevice from "@/components/Devices/FanDevice.vue";
import LightSensor from "@/components/Devices/LightSensor.vue";
import router from "@/router/index.js";
import useUserStore from "@/stores/user.js";


const route = useRoute()
const roomId = route.params.id
const room = ref(null)
const toast = useToast();

const userStore = useUserStore()
const isAdmin = ref(false)

if (userStore.user.role === 'admin') {
  isAdmin.value = true
}

const showAddForm = ref(false);
const deviceOptions = [
  { label: 'Temperature', value: 'bbc-temp' },
  { label: 'Led', value: 'bbc-led' },
  { label: 'Relay', value: 'relay' },
  { label: 'Humidity', value: 'huma' },
  { label: 'Fan', value: 'bbc-quat' },
  { label: 'Light Sensor', value: 'bbc-light' },
]

const selectedDevice = ref('')

async function getRoomDetail(){
    const res = await axiosClient.get(`/room/${roomId}`)
    room.value = res.data
}

const deviceComponentMap = {
  'bbc-led': LedDevice,
  'temp': TEMP,
  'huma' : HUMIDITY,
  'bbc-temp' : TEMP,
  'relay': RelayDevice,
  'bbc-quat' : FanDevice,
  'bbc-light' : LightSensor
};

async function deleteDevice(deviceId){
  try {
    await axiosClient.delete(`/room/${roomId}/remove-device/${deviceId}`)
    toast.success('Delete device successfully', {
      position: 'top',
    })
    room.value.device = room.value.device.filter(d => d.id !== deviceId)
  }catch (e){
    toast.error("Delete device error")
    console.error('Lỗi xoá thiết bị:', e)
  }
}

async function deleteRoom(){
  try {
    await axiosClient.delete(`/room/${roomId}`)
    await router.push({name: 'home'})
    toast.success('Delete room successfully', {
      position: 'top',
    })
  }catch (e){
    toast.success('Delete room fail', {
      position: 'top',
    })
    console.error('Lỗi xoá phòng:', e)
  }
}

async function addDevice() {
  if (!selectedDevice.value) {
    alert('Vui lòng chọn thiết bị trước khi thêm')
    return
  }

  try {
    await axiosClient.post(`/room/${roomId}/add-device`, {
      name: selectedDevice.value,
    })
    toast.success('Add devices successfully', {
      position: 'top',
    })
    selectedDevice.value = ''
    await getRoomDetail()
    showAddForm.value = false
  } catch (e) {
    toast.error('Add devices fail', {
      position: 'top',
    })
    console.error('Lỗi thêm thiết bị:', e)
  }
}

onMounted(async () => {
  await getRoomDetail();

})
</script>

<template>
  <div class="p-6" v-if="room">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-3xl font-bold">Phòng: {{ room.name }}</h1>
        <p class="text-gray-600">Chủ phòng: {{ room.owner.name }}</p>
      </div>

      <div class="flex flex-wrap gap-3 justify-end items-center">
        <!-- Nút Thêm Thiết Bị -->
        <button
          v-if="isAdmin"
          @click="showAddForm = !showAddForm"
          class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition"
        >
          <span>➕</span> Thêm thiết bị
        </button>



        <!-- Nút Xoá Phòng -->
        <button
          v-if="isAdmin"
          @click="deleteRoom"
          class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition"
        >
          <span>🗑️</span> Xoá phòng
        </button>
      </div>

    </div>

    <h2 class="text-xl font-semibold mt-6 mb-2">Thiết bị:</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <component
        v-for="device in room.device"
        :key="device.id"
        :is="deviceComponentMap[device.name]"
        :device="device"
        :onDelete ="deleteDevice"
        :isAdmin ="isAdmin"
      >
        {{ device.name }} - (Chưa có component)
      </component>
    </div>
  </div>
  <div v-if="showAddForm" class="flex items-center justify-center gap-4 mt-4">
    <select
      v-model="selectedDevice"
      class="border border-gray-300 rounded px-4 py-2"
    >
      <option disabled value="">-- Chọn thiết bị --</option>
      <option
        v-for="option in deviceOptions"
        :key="option.value"
        :value="option.value"
      >
        {{ option.label }}
      </option>
    </select>

    <button
      @click="addDevice"
      class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow"
    >
      ➕ Xác nhận thêm thiết bị
    </button>
  </div>
</template>

