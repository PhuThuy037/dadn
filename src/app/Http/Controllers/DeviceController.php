<?php

namespace App\Http\Controllers;

use App\Services\AdafruitService;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    //
    protected $adafruit;

    public function __construct(AdafruitService $adafruit)
    {
        $this->adafruit = $adafruit;
    }

    public function getDeviceStatus(string $device)
    {
        $data = $this->adafruit->getFeed($device);
        return response()->json($data);
    }
    function handleDevice($feed,$status)
    {
        $data = $this->adafruit->handleDevice($feed,$status);
        return response()->json($data);
    }

}
