<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Throwable;

class CartService extends Controller
{
    static function index($id)
    {
        try {
            $cart = Cart::where('cookie_id' , $id)->orWhere('id' , $id)->get();
            return parent::success($cart , Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function store($data)
    {
        DB::beginTransaction();
        try {
            Cart::create($data);
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'CREATE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function show($id)
    {
        try {
            return parent::success(Cart::find($id), Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function update($id, $data)
    {
        DB::beginTransaction();
        try {
            Cart::find($id)->update($data);
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'UPDATE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function destroy($id)
    {
        DB::beginTransaction();
        try {
            Cart::find($id)->delete();
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'DELETE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
