<?php

namespace App\Services;

use App\Models\Building;

class BuildingServices
{
    public function __construct(
        private readonly Building $building
    ){}
    public function getBuildings(){}
    public function createBuilding(array $values){
        return $this->building->create([
            'name' => $values['name'],
            "address" => $values['address'],
        ]);
    }
    public function updateBuilding($building){}
    public function getBuildingRooms(){}
}
