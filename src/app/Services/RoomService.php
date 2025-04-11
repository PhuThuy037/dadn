<?php

namespace App\Services;

use App\Models\Room;

class RoomService
{
    public function __construct(
        private readonly Room $room){}
    public function createRoom(array $room){
        return $this->room->create([
            'name'=>$room['name'],
            'building_id'=>1,
        ]);
    }
    public function updateRoom(array $room,$id){

        try {

            $rom = $this->room->find($id);

            if($rom){
                 $rom->update([
                    'name' => $room['name'],
                ]);
            }
            return $rom;
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }

    }
    public function deleteRoom($id){
        try {
            $rom = $this->room->find($id);
            if($rom){
                $rom->delete();
                return response()->json(['success' => 'Delete success'], 200);
            }

        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }

    }
    public function getRoomById(int $roomId){
        try {
            $rom = $this->room->with('device')->find($roomId);
            return $rom;
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
    public function getAllRooms(){
        try {
            $rooms = $this->room->with(['device', 'owner'])->get();
            return $rooms;
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }

    }
    public function addDevice(array $device,$roomId){
        try {
            $room = $this->room->find($roomId);
            if ($room) {
                return $room->device()->create([
                    'name' => $device['name'],
                    'Status' => 'OFF'
                ]);
            }
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }

    }
    public function deleteDevice(int $roomId,$deviceId){
        try {
            $room = $this->room->find($roomId);

            if (!$room) {
                return response()->json(['error' => 'Room not found'], 404);
            }

            $device = $room->device()->where('id', $deviceId)->first();

            if (!$device) {
                return response()->json(['error' => 'Device not found in this room'], 404);
            }

            $device->delete();
            return response()->json(['success' => 'Delete success'], 200);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }

}
