<script setup>
import { ref, onMounted } from 'vue'
import {toggleDeviceStatus, getDeviceStatus, sendTelegramMessage} from '@/Helper/deviceService'
import axiosClient from "@/axiosCustom.js";

const props = defineProps({
  onDelete: {
    type: Function,
    required: true
  },
  device: {
    type: Object,
    required: true,

  }
})


const deleteThisDevice = () => {

  props.onDelete(props.device.id)
}

const isOn = ref(false)


const fetchDeviceStatus = async () => {
  try {
    const res = await getDeviceStatus(props.device.name)
    isOn.value = res.data.status === 1
  } catch (e) {
    console.error('Lỗi khi lấy trạng thái thiết bị', e)
  }
}

onMounted(() => {
  fetchDeviceStatus()
})

const toggleLED = async () => {
  const newStatus = isOn.value ? 0 : 1

  try {
    await toggleDeviceStatus(props.device.room_id, props.device.name, newStatus)
    isOn.value = !isOn.value
    const action = isOn.value ? 'Bật' : 'Tắt'
    const message = `💡 Thiết bị LED đã được ${action}`
    await sendTelegramMessage(message)
    console.log(`[LED ${props.device.name}] đã gửi lệnh: ${newStatus}`)
  } catch (error) {
    console.error('Không thể cập nhật trạng thái thiết bị', error)
  }
}
</script>



<template>
  <div
    class="bg-gradient-to-br from-yellow-100 via-white to-white p-6 rounded-2xl shadow-lg transition hover:shadow-xl relative"
  >
    <!-- Nút xoá góc phải trên -->
    <button
      @click="deleteThisDevice"
      class="absolute top-3 right-3 text-gray-400 hover:text-red-600 transition-colors"
      title="Xoá thiết bị"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M8.257 3.099c.366-.446.957-.693 1.561-.693h.364c.604 0 1.195.247 1.561.693L13.414 5H17a1 1 0 110 2h-1.07l-.948 9.022A2 2 0 0113.99 18H6.01a2 2 0 01-1.992-1.978L3.07 7H2a1 1 0 110-2h3.586l1.671-1.901zM7 9a1 1 0 012 0v5a1 1 0 11-2 0V9zm4 0a1 1 0 012 0v5a1 1 0 11-2 0V9z" clip-rule="evenodd" />
      </svg>
    </button>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold text-yellow-600">💡 {{ device.name }}</h2>
      <span
        :class="isOn ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'"
        class="text-xs font-semibold px-3 py-1 rounded-full"
      >
        {{ isOn ? 'ON' : 'OFF' }}
      </span>
    </div>

    <div class="flex justify-center mt-4">
      <button
        @click="toggleLED"
        :class="isOn ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'"
        class="text-white font-semibold px-6 py-2 rounded-full shadow-md transition"
      >
        {{ isOn ? 'Tắt đèn' : 'Bật đèn' }}
      </button>
    </div>
  </div>
</template>

