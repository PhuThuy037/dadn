<script setup>
import { computed, onMounted, ref } from 'vue'
import { getDeviceStatus } from '@/Helper/deviceService'

const props = defineProps({
  onDelete: {
    type: Function,
    required: true
  },
  device: {
    type: Object,
    required: true
  },
  isAdmin : Boolean
})

const deleteThisDevice = () => {
  props.onDelete(props.device.id)
}

const lightValue = ref(0)

const fetchDeviceStatus = async () => {
  try {
    const res = await getDeviceStatus(props.device.name)
    lightValue.value = res.data.last_value ?? 0
  } catch (e) {
    console.error('Lỗi khi lấy trạng thái ánh sáng:', e)
  }
}

onMounted(fetchDeviceStatus)

const status = computed(() => {
  return lightValue.value > 0 ? 'ON' : 'OFF'
})
</script>

<template>
  <div class="relative bg-white border-2 border-yellow-300 rounded-2xl p-6 shadow-md hover:shadow-xl transition duration-300">
    <!-- Nút xoá thiết bị -->
    <button
      v-if="isAdmin"
      @click="deleteThisDevice"
      class="absolute top-3 right-3 text-gray-400 hover:text-red-600 transition-colors"
      title="Xoá thiết bị"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M8.257 3.099c.366-.446.957-.693 1.561-.693h.364c.604 0 1.195.247 1.561.693L13.414 5H17a1 1 0 110 2h-1.07l-.948 9.022A2 2 0 0113.99 18H6.01a2 2 0 01-1.992-1.978L3.07 7H2a1 1 0 110-2h3.586l1.671-1.901zM7 9a1 1 0 012 0v5a1 1 0 11-2 0V9zm4 0a1 1 0 012 0v5a1 1 0 11-2 0V9z" clip-rule="evenodd" />
      </svg>
    </button>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold text-yellow-600">☀️ Ánh sáng</h2>
      <span
        :class="status === 'ON' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-500'"
        class="text-xs px-3 py-1 rounded-full font-semibold"
      >
        {{ status }}
      </span>
    </div>

    <p class="text-5xl font-extrabold text-gray-800 text-center">
      {{ lightValue }} %
    </p>
  </div>
</template>
