<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\ControllersService;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Throwable;

class LocationService
{
    static function index()
    {
        try {
            $locations = Location::get();
            return LocationResource::collection($locations)
            ->additional(['message' => Messages::getMessage('operation accomplished successfully') , 'code' => 200 , 'status' => true]);
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
