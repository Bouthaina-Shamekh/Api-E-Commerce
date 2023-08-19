<?php

namespace App\Services;

use Throwable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Helpers\Messages;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\ControllersService;

class OrderService extends Controller
{
    static function index($id)
    {
        try {
            $order = Order::where('user_id', Auth::guard('sanctum')->user()->id)->first();
          //  return $order;

            OrderResource::collection(Order::get())
            ->additional(['code' => 200, 'status' => true, 'message' =>  Messages::getMessage('operation accomplished successfully')]);


        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }

            // $order=Order::leftJoin('order_items as oi', 'oi.order_id','=','orders.id')
            // ->select([ 'orders.id', 'orders.address_id', 'orders.total', 'orders.discount','oi.product_id','oi.product_name','oi.price'])
            // ->where('orders.id',$id)
            // ->first();
            // return response()->json([
            //     'data'=>[
            //         'copoun_id'=>$order->copoun_id,
            //         'address_id'=>$order->address_id,
            //         'user_id'=>$order->user_id,
            //         'total'=>$order->total,
            //         'discount'=>$order->discount,
            //         'attributes'=>[

            //             'product_id'=>$orderItem->product_id,
            //             'variant_id'=>$orderItem->variant_id,
            //             'order_id'=>$orderItem->order_id,
            //             'product_name'=>$orderItem->product_name,
            //             'price'=>$orderItem->price,
            //         ]

            //     ]


            // ]);

        //     return parent::success($order , Messages::getMessage('operation accomplished successfully'));
        // } catch (Throwable $e) {
        //     return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        // }
    }

    static function store($data)
    {
        DB::beginTransaction();
        $order = Order::get();
        try {

            Order::create($data);
            // $order=Order::create([
            //     'user_id'=> 2,
            //     'copoun_id'=>$data['copoun_id'],
            //     'address_id'=>$data['address_id'],
            //     'total'=>$data['total'],
            //     'discount'=>$data['discount']

            // ]);
            $carts = Cart::where('user_id',$data['user_id'])->get();

                foreach($carts as $cart){
                    $product = Product::find($cart->product_id);
                    OrderItem::create([
                        'product_id'=>$cart->product_id,
                        'variant_id'=>$cart->variant_id,
                        'order_id'=>$order->id,
                        'product_name'=>$product->name,
                        'price'=>$product->price,
                    ]);

                    Cart::find($cart->id)->delete();
                }

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
            return parent::success(Order::find($id), Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function update($id, $data)
    {
        /* DB::beginTransaction();
        try {
            Order::find($id)->update($data);
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'UPDATE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        } */
    }

    static function destroy($id)
    {
        DB::beginTransaction();
        try {
            Order::find($id)->delete();
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'DELETE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
