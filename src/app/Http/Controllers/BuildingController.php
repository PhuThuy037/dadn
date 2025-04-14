<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use App\Services\BuildingServices;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    //
    protected $building;

    public function __construct(BuildingServices $building){
        $this->building = $building;
    }
    public function createBuilding(BuildingRequest $building)
    {
            return $this->building->createBuilding($building->validated());
    }

}
