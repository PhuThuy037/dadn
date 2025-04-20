<script setup>
import { ref, onMounted } from 'vue'
import {toggleDeviceStatus, getDeviceStatus, sendTelegramMessage} from '@/Helper/deviceService'

const props = defineProps({
  device: Object,
  onDelete: Function
})

const level = ref(0)

const fetchDeviceStatus = async () => {
  try {
    const res = await getDeviceStatus(props.device.id)
    level.value = res.data.status || 0
  } catch (e) {
    console.error('Lỗi khi lấy trạng thái quạt:', e)
  }
}

const setFanLevel = async (newStatus) => {
  try {
    await toggleDeviceStatus(props.device.room_id, props.device.name, newStatus)
    const message = `🌀 Thiết bị Quạt đã được bât`
    await sendTelegramMessage(message)
    level.value = newStatus
  } catch (e) {
    console.error('Lỗi khi thay đổi mức độ gió:', e)
  }
}

onMounted(fetchDeviceStatus)
</script>

<template>
  <div class="relative bg-white border-2 border-sky-300 p-6 rounded-2xl shadow hover:shadow-lg transition">
    <!-- Nút xoá -->
    <button
      @click="props.onDelete(props.device.id)"
      class="absolute top-3 right-3 text-gray-400 hover:text-red-600"
      title="Xoá thiết bị"
    >
      🗑️
    </button>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold text-sky-600">🌀 Quạt</h2>
      <span
        :class="level > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-500'"
        class="text-xs font-semibold px-3 py-1 rounded-full"
      >
        {{ level > 0 ? `Mức ${level}` : 'OFF' }}
      </span>
    </div>

    <!-- Nút tắt -->
    <div class="mb-3 text-center">
      <button
        @click="setFanLevel(0)"
        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-full shadow-sm text-sm font-medium"
      >
        ❌ Tắt quạt
      </button>
    </div>

    <!-- 3 nút mức gió -->
    <div class="grid grid-cols-3 gap-2">
      <button
        @click="setFanLevel(50)"
        :class="level === 50 ? 'bg-blue-600' : 'bg-blue-400 hover:bg-blue-500'"
        class="text-white px-3 py-2 rounded shadow text-sm font-medium"
      >
        💨 Yếu
      </button>
      <button
        @click="setFanLevel(70)"
        :class="level === 70 ? 'bg-yellow-500' : 'bg-yellow-400 hover:bg-yellow-500'"
        class="text-white px-3 py-2 rounded shadow text-sm font-medium"
      >
        🌬️ Trung bình
      </button>
      <button
        @click="setFanLevel(90)"
        :class="level === 90 ? 'bg-red-500' : 'bg-red-400 hover:bg-red-500'"
        class="text-white px-3 py-2 rounded shadow text-sm font-medium"
      >
        💥 Mạnh
      </button>
    </div>
  </div>
</template>
