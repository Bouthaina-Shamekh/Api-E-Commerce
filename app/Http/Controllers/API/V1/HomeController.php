<?php

namespace App\Http\Controllers\API\V1;

use App\Services\HomeService;

class HomeController
{

    public function __invoke()
    {
        return HomeService::index();
    }
}
