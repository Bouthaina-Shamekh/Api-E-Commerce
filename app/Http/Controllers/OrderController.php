<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Copoun;
use App\Models\Address;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!Gate::allows('order-view')) {
            abort(500);
        }
        if ($request->ajax()) {
            $data = Order::orderBy('id','desc');

            return DataTables::of($data)

                ->editColumn('user_id', function ($row) {

                    return User::find($row->user_id)->name;
                })
                ->editColumn('copoun_id', function ($row) {

                    return Copoun::find($row->copoun_id)->code;
                })
                ->editColumn('address_id', function ($row) {

                    return Address::find($row->address_id)->title;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="modal-effect btn btn-sm btn-warning" style="margin: 5px" href="order/'. $row->id . '/edit""><i class="las la-eye la-lg"></i></a>';

                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="showModalDeleteOrder" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->filter(function ($data) use ($request) {

                    if ($request->has('userId') and $request->get('userId') != "") {

                        $data->where('user_id',"{$request->get('userId')}");
                    }

                    if ($request->has('statusId') and $request->get('statusId') != "") {

                        $data->where('status',"{$request->get('statusId')}");
                    }
                    if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                        $from=$request->get('fromId');
                        $to=$request->get('toId');
                        $data->whereBetween('created_at',[$from,$to]);
                     }
                     if ($request->has('fromId2') and $request->has('toId2') and $request->get('fromId2') != "" and $request->get('toId2') != "") {
                        $from2=$request->get('fromId2');
                        $to2=$request->get('toId2');
                        $data->whereBetween('total',[$from2,$to2]);
                     }


                })
                ->rawColumns(['action' => 'action'])->make(true);
        }

        $users = User::get();
        return view('dashboard.views-dash.order.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $orderItem = OrderItem::findOrFail($id);
        $user = User::select('id','name')->get();
        return view('dashboard.views-dash.order.edit', compact('order','user','orderItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        "user_id" => 'required',
        "copoun_id" => 'required',
        "address_id" => 'required',
        "total" => 'required',
        "price" => 'required',
        "discount" => 'required',
        "status" => 'required',
        "payment_status" => 'required',
        ]);

        $order = Order::findOrFail($id);
        // $user = User::where('name', $request->user_name)->first();

        $order->update([
         "user_id" => $request->user_id,
        "copoun_id" => $request->copoun_id,
        "address_id" => $request->address_id,
        "total" => $request->total,
        "price" => $request->price,
        "discount" => $request->discount,
        "status" => $request->status,
        "payment_status" => $request->payment_status,

    ]);


      return redirect()->route('order.index')->with('msg', 'Order updated successfully')->with('type', 'info');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.destroy')->with('msg', 'Order deleted successfully')->with('type', 'danger');

    }


    public function ChangeStatus($id,$status){
        $order=Order::find($id);
        $order->status=$status;
        $order->save();
        return response()->json(['status' => '1']);
    }
}
