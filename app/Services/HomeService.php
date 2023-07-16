<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Http\Resources\AdResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use Throwable;

class HomeService extends Controller
{
    static function index()
    {
        try {
            $ads = Ad::get();
            $categories = Category::where('parent_id', null)->get();
            $productsNew = Product::with('user_review', 'category')->withCount('reviews')->withSum('reviews', 'rate')->filter(['type' => 'NEW'])->take(10)->get();
            $productsMostBought = Product::with('user_review', 'category')->withCount('reviews')->withSum('reviews', 'rate')->filter(['type' => 'MOSTBOUGHT'])->take(10)->get();
            $productsMostWatched = Product::with('user_review', 'category')->withCount('reviews')->withSum('reviews', 'rate')->filter(['type' => 'MOSTWATCHED'])->take(10)->get();
            $productsMostFavourite = Product::with('user_review', 'category')->withCount('reviews')->withSum('reviews', 'rate')->filter(['type' => 'MOSTFAVOURITE'])->take(10)->get();
            $data = [
                'ads' => AdResource::collection($ads),
                'categories' => CategoryResource::collection($categories),
                'productsNew' => ProductResource::collection($productsNew),
                'productsMostBought' => ProductResource::collection($productsMostBought),
                'productsMostWatched' => ProductResource::collection($productsMostWatched),
                'productsMostFavourite' => ProductResource::collection($productsMostFavourite),
            ];
            return parent::success($data, Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
