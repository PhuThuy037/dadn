<script setup>
import { ref, onMounted } from 'vue'
import { toggleDeviceStatus, getDeviceStatus } from '@/Helper/deviceService'

const props = defineProps({
  device: Object,
  onDelete: Function
})

const isOn = ref(false)

const fetchDeviceStatus = async () => {
  try {
    const res = await getDeviceStatus(props.device.id)
    isOn.value = res.data.status === 1
  } catch (e) {
    console.error('Lỗi khi lấy trạng thái relay:', e)
  }
}

const toggleRelay = async () => {
  const newStatus = isOn.value ? 0 : 1
  try {
    await toggleDeviceStatus(props.device.room_id, props.device.name, newStatus)
    isOn.value = !isOn.value
  } catch (e) {
    console.error('Lỗi khi bật/tắt relay:', e)
  }
}

onMounted(fetchDeviceStatus)
</script>

<template>
  <div class="relative bg-white border-2 border-purple-300 p-6 rounded-2xl shadow hover:shadow-lg transition">
    <!-- Nút xoá -->
    <button
      @click="props.onDelete(props.device.id)"
      class="absolute top-3 right-3 text-gray-400 hover:text-red-600"
      title="Xoá thiết bị"
    >
      🗑️
    </button>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold text-purple-600">🔌 Relay</h2>
      <span
        :class="isOn ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-500'"
        class="text-xs font-semibold px-3 py-1 rounded-full"
      >
        {{ isOn ? 'ON' : 'OFF' }}
      </span>
    </div>

    <div class="flex justify-center">
      <button
        @click="toggleRelay"
        :class="isOn ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'"
        class="text-white font-semibold px-6 py-2 rounded-full shadow"
      >
        {{ isOn ? 'Tắt Relay' : 'Bật Relay' }}
      </button>
    </div>
  </div>
</template>
