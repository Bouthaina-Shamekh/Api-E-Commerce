<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        return ProductService::index($request->all());
    }

    public function show($id)
    {
        return ProductService::show($id);
    }
}
