import axiosClient from '@/axiosCustom'

export const toggleDeviceStatus = async (roomId,deviceId, status) => {
  return await axiosClient.post(`/devices/${deviceId}/room/${roomId}/status/${status}`)
}

export const getDeviceStatus = async (deviceId)=>{
  return await axiosClient.get(`/devices/${deviceId}`)
}
