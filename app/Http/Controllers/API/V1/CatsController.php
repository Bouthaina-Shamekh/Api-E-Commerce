<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CatsController extends Controller
{
    public function index(Request $request)
    {
        return CartService::index($request->id);
    }

    public function store(CartRequest $cartRequest)
    {
        return CartService::store($cartRequest->cartData());
    }

    public function show($id)
    {
        return CartService::show($id);
    }

    public function update(CartRequest $cartRequest , $id)
    {
        return CartService::update($id , $cartRequest->cartData());
    }

    public function destroy($id)
    {
        return CartService::destroy($id);
    }
}
