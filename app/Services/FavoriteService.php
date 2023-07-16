<?php

namespace App\Services;

use App\Http\Controllers\ControllersService;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class FavoriteService
{

    static function store($data)
    {
        DB::beginTransaction();
        try {
            Favorite::create($data);
            DB::commit();
            return ControllersService::generateProcessResponse(true, 'CREATE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function destory($id)
    {
        DB::beginTransaction();
        try {
            Favorite::where('product_id' , $id)->where('user_id' , Auth::user()->id)->delete();
            DB::commit();
            return ControllersService::generateProcessResponse(true, 'DELETE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

}
