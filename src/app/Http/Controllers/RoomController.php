<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomRequest;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    protected $room;
    public function __construct(RoomService $room){
        $this->room = $room;
    }
    public function createRoom(CreateRoomRequest $request){

        return $this->room->createRoom($request->validated());
    }
    public function updateRoom(CreateRoomRequest $request,$roomId){

       return $this->room->updateRoom($request->validated(),(int) $roomId);
    }
    public function deleteRoom($roomId){
        return $this->room->deleteRoom($roomId);
    }
    public function getRoom($roomId){
        return $this->room->getRoomById($roomId);
    }
    public function getAllRoom(){
        return $this->room->getAllRooms();
    }
    public function addRoomDevice(CreateRoomRequest $request,$roomId){

        return $this->room->addDevice($request->validated(),$roomId);
    }
    public function deleteRoomDevice($roomId,$deviceId){
        return $this->room->deleteDevice($roomId,$deviceId);
    }
}
