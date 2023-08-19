<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Option;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Helpers\Currency;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\VariantAttribute;
use Yajra\DataTables\DataTables;
use App\Models\Scopes\ActiveScope;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\CategoryRequest;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        // dd(route('product.edit',1));

        if (!Gate::allows('product-view')) {
            abort(500);
        }
        if ($request->ajax()) {
            $data = Product::withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('master_image', function ($row) {
                    $master_image = '<img src="/' . $row->master_image . '" alt="image" width="50" height="50">';
                    return $master_image;
                })

                ->addColumn('title', function ($row) {
                    if ($row->currentLang == 'arabic') {
                        return $row->title_ar;
                    } else {
                        return $row->title_en;
                    }
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 'ACTIVE') {
                        $status = '<button class="modal-effect btn btn-sm btn-success" style="margin: 5px" id="status" data-id="' . $row->id . '" ><i class=" icon-check"></i></button>';
                    } else {
                        $status = '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="status" data-id="' . $row->id . '" ><i class=" icon-check"></i></button>';
                    }
                    return $status;
                })

              ->addColumn('Currency', function ($row) {
                  return Currency::format($row->price);
                    })
                ->addColumn('action', function ($row) {

                    $btn = '<button class="modal-effect btn btn-sm btn-warning"  style="margin: 5px"><a href="/admin/showvariant/'.$row->id.'"
                    id="ShowModalroduct" style="font-weight: bold; color: beige;">
                    show variant</a></button>';

                    $btn =  $btn .'<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px"> <a href="/admin/product/'.$row->id.'/edit" id="showModalEditProduct"><i class="las la-pen"></i>
                    </a></button>';

                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="showModalDeleteProduct" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['master_image' => 'master_image','status' => 'status','Currency' => 'Currency', 'action' => 'action'])->make(true);
        }

    $products = Product::withoutGlobalScope(ActiveScope::class)->orderBy('id', 'desc')->get();
    return view('dashboard.views-dash.product.index', compact('products'));
    }

    public function create()
    {
        $product = new Product();
        $categories = Category::where('parent_id' , NULL)->where('status','ACTIVE')->withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();


        $attributes = Attribute::withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();

        return view('dashboard.views-dash.product.create',compact('categories','attributes','product'));
    }


    public function store(ProductRequest $productRequest)
    {

        $data=$productRequest->productData();
        $Product =  Product::create($data);

              if($data['attrr']){

                foreach ($data['attrr'] as $key => $value) {

                    if($value != null){

                        foreach (explode(',',$value) as $option) {
                            $opt= Option::create([
                                'title_ar'=>$option,
                                'title_en'=>$option,
                                'attribute_id'=>$key,
                               'product_id'=>$Product->id,
                            ]);
                         ProductAttribute::create([
                            'product_id'=>$Product->id,
                            'attribute_id'=>$key,
                            'option_id'=>$opt->id
                        ]);
                    }
                    }

                }
              }

       return redirect()->route('product.index');
    }



    public function edit($id)
    {
        $product = Product::withoutGlobalScope(ActiveScope::class)->find($id);

        $categories = Category::select('id', 'title_en', 'title_ar')->get();

        return view('dashboard.views-dash.product.update',compact('product','categories'));

    }

    public function show($id)
    {

        $categories = Category::where('parent_id' , NULL)->where('status','ACTIVE')->withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();


        $attributes = Attribute::withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();

        return view('dashboard.views-dash.product.create',compact('categories','attributes'));
    }



    public function update(ProductRequest $productRequest, $id)
    {
        Product::withoutGlobalScope(ActiveScope::class)->find($id)->update($productRequest->productData());
         return redirect()->route('product.index');


    }

   public function getFormattedAmount(Request $request){

    $amount = 1234.56;
        $locale = config('custom.number_formatter.locale');
        $currency = config('custom.number_formatter.currency');

        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        $formattedAmount = $formatter->formatCurrency($amount, $currency);

        return response()->json(['formattedAmount' => $formattedAmount]);


    }

    public function destroy($id)
    {
        $product = Product::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($product) {
            $product->delete();
            return ControllersService::responseSuccess([
                'message' => __('Deleted successfully'),
                'status' => 200,
            ]);
        }
        return ControllersService::responseErorr([
            'message' => __('Not Found Data'),
            'status' => false,
        ]);
    }

    public function status($id)
    {
        $product = Product::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($product) {
            $product->changeStatus();
            return ControllersService::responseSuccess([
                'message' => __('Updated successfully'),
                'status' => 200,
            ]);
        } else {
            return ControllersService::responseErorr([
                'message' => __('Not Found Data'),
                'status' => 400,
            ]);
        }
    }
}
