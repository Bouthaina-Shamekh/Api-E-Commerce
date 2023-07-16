<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\FavoriteRequest;
use App\Services\FavoriteService;

class FavoritesController
{
    public function store(FavoriteRequest $favoriteRequest)
    {
        return FavoriteService::store($favoriteRequest->favData());
    }

    public function destroy($id)
    {
        return FavoriteService::destory($id);
    }
}
