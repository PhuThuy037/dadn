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
}
