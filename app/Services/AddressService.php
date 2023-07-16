<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\ControllersService;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AddressService
{
    static function index()
    {

        try {
            $addresses = Address::where('user_id', Auth::guard('sanctum')->user()->id)->get();
            return $addresses;

            AddressResource::collection($addresses)
                ->additional(['code' => 200, 'status' => true, 'message' =>  Messages::getMessage('operation accomplished successfully')]);
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function store($data)
    {
        DB::beginTransaction();
        try {
            Address::create($data);
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
            $address = Address::where('id', $id)->first();
            return AddressResource::make($address)
                ->additional(['code' => 200, 'status' => true, 'message' =>  Messages::getMessage('operation accomplished successfully')]);
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function update($id, $data)
    {
        DB::beginTransaction();
        try {
            Address::find($id)->update($data);
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
            Address::find($id)->delete();
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'DELETE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
