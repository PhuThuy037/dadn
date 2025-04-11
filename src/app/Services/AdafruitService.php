<?php

namespace App\Services;
use App\Models\Device;
use App\Models\Room;
use Illuminate\Support\Facades\Http;
class AdafruitService
{
    protected $username;
    protected $baseUrl;

    protected $device;

    public function __construct(  Device $device)
    {
        $this->username = config('services.adafruit.username');
        $this->baseUrl = "https://io.adafruit.com/api/v2/{$this->username}";
        $this->device = $device;

    }

    public function getFeed($feed)
    {
        $response = Http::withHeaders([
            'X-AIO-Key' => config('services.adafruit.key'),
        ])->get("{$this->baseUrl}/feeds/{$feed}");
        return $response->successful() ? $response->json() : null;
    }
    public function handleDevice($feed,$roomId,$value)
    {
        $response = Http::withHeaders([
            'X-AIO-Key' => config('services.adafruit.key'),
        ])->post("{$this->baseUrl}/feeds/{$feed}/data", [
            'value' => $value
        ]);
        $device = Device::where('room_id', $roomId)
            ->where('name', $feed)
            ->first();
        if($value == 0 || $value == 1){
            $status = $value == 1 ? 'ON' : 'OFF';
        }
        $status = $value;
        if($device){
            $device->update([
                'Status' => $status
            ]);
        }
        return $response->successful() ? $response->json() : null;
    }


}
