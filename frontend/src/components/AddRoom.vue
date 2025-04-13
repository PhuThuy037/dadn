<script setup>
import { ref, onMounted } from 'vue'
import axiosClient from '@/axiosCustom'

import router from '@/router/index.js'

const roomName = ref('')
const selectedUser = ref(null)
const users = ref([])

const fetchUsers = async () => {
  try {
    const res = await axiosClient.get('/user/no-room');
    console.log(res.data)
    users.value = res.data.users;
  } catch (e) {
    console.error('Lỗi lấy danh sách user', e)
  }
}

const createRoom = async () => {
  if (!roomName.value || !selectedUser.value) {
    alert('Vui lòng nhập tên phòng và chọn chủ phòng')

  }

  try {
     const user_id = selectedUser.value
    await axiosClient.post(`/room/${user_id}/add`, {
      name: roomName.value,
    })
    alert('Tạo phòng thành công!')
    roomName.value = ''
    selectedUser.value = null
    await router.push({name: 'home'})
  } catch (e) {
    console.error('Lỗi tạo phòng:', e)
  }
}

onMounted(fetchUsers)
</script>

<template>
  <div class="bg-white p-6 rounded-xl shadow max-w-xl mx-auto space-y-4">
    <h2 class="text-2xl font-bold text-gray-700">🛠️ Tạo phòng mới</h2>

    <!-- Nhập tên phòng -->
    <div>
      <label class="block text-sm font-semibold text-gray-600 mb-1">Tên phòng</label>
      <input
        v-model="roomName"
        type="text"
        class="w-full border rounded px-4 py-2"
        placeholder="Nhập tên phòng..."
      />
    </div>

    <!-- Chọn user làm chủ phòng -->
    <div>
      <label class="block text-sm font-semibold text-gray-600 mb-1">Chủ phòng</label>
      <select
        v-model="selectedUser"
        class="w-full border rounded px-4 py-2"
      >
        <option disabled value="">-- Chọn chủ phòng --</option>
        <option v-for="user in users" :key="user.id" :value="user.id">
          👤 {{ user.name }} ({{ user.email }})
        </option>
      </select>
    </div>

    <!-- Nút tạo -->
    <div class="text-right">
      <button
        @click="createRoom"
        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow"
      >
        ➕ Tạo phòng
      </button>
    </div>
  </div>
</template>
