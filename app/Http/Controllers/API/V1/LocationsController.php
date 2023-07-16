<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\GovernorateCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function __invoke()
    {
        return LocationService::index();
    }
}
