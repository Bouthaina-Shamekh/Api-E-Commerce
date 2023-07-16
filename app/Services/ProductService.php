<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProductService extends Controller
{
    static function index($data)
    {
        try {
            $products = Product::select([
                'products.*', 'categories.title_ar as category_name',
                'favorites.id as favorites_id', 'reviews.id as reviews_id',
                'attributes.title_ar as attributes_title_ar',
                'attributes.title_en as attributes_title_en',
                'options.title_ar as options_title_ar',
                'options.title_ar as options_title_en',
                'product_attributes.attribute_id', 'product_attributes.option_id'
            ])
                ->join('categories', 'categories.id', '=',  'products.category_id')
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.product_id', '=',  'products.id')
                        ->where('favorites.user_id', Auth::guard('sanctum')->user()->id ?? "");
                })
                ->leftJoin('reviews', function ($join) {
                    $join->on('reviews.product_id', '=',  'products.id')
                        ->where('reviews.user_id', Auth::guard('sanctum')->user()->id ?? "");
                })
                ->leftJoin('product_attributes', 'product_attributes.product_id', '=',  'products.id')
                ->leftJoin('attributes', 'attributes.id', '=',  'product_attributes.attribute_id')
                ->leftJoin('options', 'options.id', '=',  'product_attributes.option_id')
                ->withCount('reviews')->withSum('reviews', 'rate')
                ->filter([
                    'name' => $data['name'] ?? NULL, 'type' => $data['type'] ?? NULL,
                    'from' => $data['form'] ?? NULL, 'to' => $data['to'] ?? NULL, 'category' => $data['category'] ?? NULL, 'myFavorite' => $data['myFavorite'] ?? NULL
                ])->where('products.status', 'ACTIVE')->get();
            $current = 0;
            foreach ($products as $product) {
                if ($current != 0 && $current != $product->id) {
                    $data[$current]['attributes'] = array_values($data[$current]['attributes']);
                }
                $current = $product->id;
                if (!isset($data[(int) $product->id])) {
                    $data[(int)$product->id] = [
                        'id' => $product->id,
                        'category_id' => $product->category_id,
                        'title_ar' => $product->title_ar,
                        'title_en' => $product->title_en,
                        'master_image' => $product->master_image,
                        'description_ar' => $product->description_ar,
                        'description_en' => $product->description_en,
                        'price' => $product->price,
                        'discount' => $product->discount,
                        'general_info_ar' => $product->general_info_ar,
                        'general_info_en' => $product->general_info_en,
                        'specefications_ar' => $product->specefications_ar,
                        'specefications_en' => $product->specefications_en,
                        'status' => $product->status,
                        'type' => $product->type,
                        'reviews_count' => $product->reviews_count,
                        'reviews_sum_rate' => $product->reviews_sum_rate,
                        'favorites_id' => $product->favorites_id,
                        'reviews_id' => $product->reviews_id,
                    ];
                }
                if (!isset($data[(int)$product->id]['attributes'][(int)$product->attribute_id])) {
                    $data[(int)$product->id]['attributes'][(int)$product->attribute_id] = [
                        'attribute_id' => $product->attribute_id,
                        'title_ar' => $product->attributes_title_ar,
                        'title_en' => $product->attributes_title_en,
                    ];
                }
                $data[(int)$product->id]['attributes'][(int)$product->attribute_id]['options'][] = [
                    'option_id' => $product->option_id,
                    'title_ar' => $product->options_title_ar,
                    'title_en' => $product->options_title_en,
                ];
            }
            $data[$current]['attributes'] = array_values($data[$current]['attributes']);
            return parent::success(array_values($data),  Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function show($id)
    {
        try {
            $products = Product::select([
                'products.*', 'categories.title_ar as category_name',
                'favorites.id as favorites_id', 'reviews.id as reviews_id',
                'attributes.title_ar as attributes_title_ar',
                'attributes.title_en as attributes_title_en',
                'options.title_ar as options_title_ar',
                'options.title_ar as options_title_en',
                'product_attributes.attribute_id', 'product_attributes.option_id'
            ])
                ->join('categories', 'categories.id', '=',  'products.category_id')
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.product_id', '=',  'products.id')
                        ->where('favorites.user_id', Auth::guard('sanctum')->user()->id ?? "");
                })
                ->leftJoin('reviews', function ($join) {
                    $join->on('reviews.product_id', '=',  'products.id')
                        ->where('reviews.user_id', Auth::guard('sanctum')->user()->id ?? "");
                })
                ->leftJoin('product_attributes', 'product_attributes.product_id', '=',  'products.id')
                ->leftJoin('attributes', 'attributes.id', '=',  'product_attributes.attribute_id')
                ->leftJoin('options', 'options.id', '=',  'product_attributes.option_id')
                ->withCount('reviews')->withSum('reviews', 'rate')
                ->where('products.status', 'ACTIVE')
                ->where('products.id' , $id)->get();

            $current = 0;
            $data = [];
            foreach ($products as $product) {
                if ($current != 0 && $current != $product->id) {
                    $data[$current]['attributes'] = array_values($data[$current]['attributes']);
                }
                $current = $product->id;
                if (!isset($data[(int) $product->id])) {
                    $data[(int)$product->id] = [
                        'id' => $product->id,
                        'category_id' => $product->category_id,
                        'title_ar' => $product->title_ar,
                        'title_en' => $product->title_en,
                        'master_image' => $product->master_image,
                        'description_ar' => $product->description_ar,
                        'description_en' => $product->description_en,
                        'price' => $product->price,
                        'discount' => $product->discount,
                        'general_info_ar' => $product->general_info_ar,
                        'general_info_en' => $product->general_info_en,
                        'specefications_ar' => $product->specefications_ar,
                        'specefications_en' => $product->specefications_en,
                        'status' => $product->status,
                        'type' => $product->type,
                        'reviews_count' => $product->reviews_count,
                        'reviews_sum_rate' => $product->reviews_sum_rate,
                        'favorites_id' => $product->favorites_id,
                        'reviews_id' => $product->reviews_id,
                    ];
                }
                if (!isset($data[(int)$product->id]['attributes'][(int)$product->attribute_id])) {
                    $data[(int)$product->id]['attributes'][(int)$product->attribute_id] = [
                        'attribute_id' => $product->attribute_id,
                        'title_ar' => $product->attributes_title_ar,
                        'title_en' => $product->attributes_title_en,
                    ];
                }
                $data[(int)$product->id]['attributes'][(int)$product->attribute_id]['options'][] = [
                    'option_id' => $product->option_id,
                    'title_ar' => $product->options_title_ar,
                    'title_en' => $product->options_title_en,
                ];
            }
            $data[$current]['attributes'] = array_values($data[$current]['attributes']);
            $data = array_values($data);
            return parent::success($data[0],  Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}


// SELECT * FROM variants
// inner join `variant_attributes` as v1 on v1.variant_id = variants.id
// INNER join `variant_attributes` as v2 on v2.variant_id = variants.id
// -- inner join `variant_attributes` as v3 on v3.variant_id = variants.id
// WHERE v1.option_id = 1
// and v2.option_id = 7
// -- and v3.option_id = ?
// and variants.product_id = 2


// SELECT * FROM product_attributes a1
// cross join product_attributes a2 on a2.product_id = a1.product_id and a2.attribute_id <> a1.attribute_id
// cross join product_attributes a3 on a3.product_id = a1.product_id and a3.attribute_id <> a1.attribute_id and a3.attribute_id <> a2.attribute_id
// WHERE a1.product_id = 2;


// SELECT
//     a1.attribute_id attribute1,
//     a1_options.option_id AS option1,
//     a2.attribute_id AS attribute2,
//     a2_options.option_id AS option2,
//     a3.attribute_id AS attribute3,
//     a3_options.option_id AS option3
// FROM
//     (SELECT DISTINCT attribute_id FROM product_attributes) a1
// CROSS JOIN
//     (SELECT DISTINCT option_id FROM product_attributes) a1_options
// JOIN
//     (SELECT DISTINCT attribute_id FROM product_attributes) a2
// CROSS JOIN
//     (SELECT DISTINCT option_id FROM product_attributes) a2_options
// JOIN
//     (SELECT DISTINCT attribute_id FROM product_attributes) a3
// CROSS JOIN
//     (SELECT DISTINCT option_id FROM product_attributes) a3_options
// ORDER BY
//     attribute1, attribute2, attribute3;
