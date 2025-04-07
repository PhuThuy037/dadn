<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class AdafruitService
{
    protected $username;
    protected $baseUrl;

    public function __construct()
    {
        $this->username = config('services.adafruit.username');
        $this->baseUrl = "https://io.adafruit.com/api/v2/{$this->username}";
    }

    public function getFeed($feed)
    {
        $response = Http::withHeaders([
            'X-AIO-Key' => config('services.adafruit.key'),
        ])->get("{$this->baseUrl}/feeds/{$feed}");

        return $response->successful() ? $response->json() : null;
    }
    public function handleDevice($feed,$value)
    {
        $response = Http::withHeaders([
            'X-AIO-Key' => config('services.adafruit.key'),
        ])->post("{$this->baseUrl}/feeds/{$feed}/data", [
            'value' => $value
        ]);

        return $response->successful() ? $response->json() : null;
    }


}
