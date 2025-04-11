<script setup>
import { ref, onMounted } from "vue";
import axiosClient from "@/axiosCustom";
import { useToast } from 'vue-toast-notification'
import Room from "@/components/Room.vue";
const toast = useToast()
const rooms = ref([]);

async function fetchRooms() {
  try {
    const res = await axiosClient.get('/room/all');
    rooms.value = res.data;

  } catch (error) {
    console.log(error)
  }
}
onMounted(()=>{
  fetchRooms()
})

</script>

<template>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-6">

    <Room
      v-for="room in rooms"
      :key="room.id"
      :name="room.name"
      :owner="room.owner.name"
      :devicesCount="room.device.length"
    />


        </div>
      </template>
