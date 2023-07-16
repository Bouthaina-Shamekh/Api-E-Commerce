<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressesController extends Controller
{

    public function index()
    {
        return AddressService::index();
    }

    public function store(AddressRequest $addressRequest)
    {
        return AddressService::store($addressRequest->addressData());
    }

    public function show($id)
    {
        $address = Address::where('id' , $id)->first();
        return AddressResource::make($address)
                ->additional(['code' => 200, 'status' => true, 'message' =>  Messages::getMessage('operation accomplished successfully')]);
    }

    public function update(AddressRequest $addressRequest, $id)
    {
        return AddressService::update($id , $addressRequest->addressData());
    }

    public function destroy($id)
    {
        return AddressService::destroy($id);
    }
}
