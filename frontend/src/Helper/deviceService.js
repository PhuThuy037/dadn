import axiosClient from '@/axiosCustom'

export const toggleDeviceStatus = async (roomId,deviceId, status) => {
  return await axiosClient.post(`/devices/${deviceId}/room/${roomId}/status/${status}`)
}

export const getDeviceStatus = async (deviceId)=>{
  return await axiosClient.get(`/devices/${deviceId}`)
}
export async function sendTelegramMessage(message) {
  const token = import.meta.env.VITE_TOKEN_TELE;
  const chatId = import.meta.env.VITE_CHAT_TELE;
  const url = `https://api.telegram.org/bot${token}/sendMessage`;

  const payload = {
    chat_id: chatId,
    text: message,
  };

  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(payload),
    });

    const data = await res.json();
    console.log('✅ Gửi thành công:', data);
  } catch (err) {
    console.error('❌ Lỗi khi gửi tin nhắn:', err);
  }
}

