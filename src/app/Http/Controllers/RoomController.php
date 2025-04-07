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
}
