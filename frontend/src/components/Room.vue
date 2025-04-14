<script setup>
import {useRouter} from "vue-router";
import Login from "@/pages/Login.vue";

const props = defineProps({
  name: String,
  owner: String,
  devicesCount: Number,
  id : Number
});
const router = useRouter()

function goToRoomDetail() {

  router.push({ name: 'RoomDetail', params: { id :props.id } })
}
</script>

<template>
  <div @click="goToRoomDetail"
    class="bg-gradient-to-br from-blue-100 via-white to-white border border-blue-200 rounded-2xl shadow-lg p-6 hover:scale-[1.02] transition-transform duration-300"
  >
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-2xl font-extrabold text-blue-700">
        🏢 {{ name }}
      </h2>
      <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full shadow-sm">
        {{ devicesCount }} thiết bị
      </span>
    </div>

    <div class="text-gray-700 text-lg space-y-2">
      <p>👤 <strong>Chủ phòng:</strong> {{ owner }}</p>
    </div>
  </div>
</template>
