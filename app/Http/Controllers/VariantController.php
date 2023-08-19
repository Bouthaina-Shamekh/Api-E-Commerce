<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\VariantAttribute;
use Yajra\DataTables\DataTables;
use App\Models\Scopes\ActiveScope;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class VariantController extends Controller
{


    public function showAllVariant(Request $request,$id){

        if (!Gate::allows('variant-view')) {
            abort(500);
        }
        if ($request->ajax()) {
            $data = Variant::where('product_id',$id)->orderBy('id' , 'desc')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('product_name', function ($row) {

                    return $row->product->title_en;
                })
                ->addColumn('attribute', function ($row) {
                    return implode(', ', $row->options->pluck('title_en')->toArray());
                })
                ->addColumn('image', function ($row) {
                    $variant =Variant::find($row->id);
                    $image = '<img src="/' . $row->image . '" alt="image" width="50" height="50">';
                    return $image;
                })

                ->addColumn('action', function ($row) {

                    $btn = '<button class="modal-effect btn btn-sm btn-info" style="margin: 5px"> <a href="/admin/variant/' . $row->id . '/edit" id="showModalEditariant"><i class="las la-pen"></i></a></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="showModalDeleteVariant" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['product_name','image' => 'image','action' => 'action'])->make(true);
        }

        return view('dashboard.views-dash.variant.index',compact('id'));

       }



       function addVarint($id){

        $data = ProductAttribute::where('product_id','=',$id)->distinct('attribute_id')->get('attribute_id');

        return view('dashboard.views-dash.variant.create',compact('data','id'));

    }


    public function store(Request $request)
    {
       //dd($request);
         $this->validate($request,
            [
                'product_id' => 'required',
                //'image' => 'required',
                'price' => 'required',
                'discount' => 'required',
            ]);

        $newOptions = [];
        $oldOptions =[];
        foreach($request->except('_token') as $key =>$rq){
            if(is_int($key)){
                array_push($newOptions,$rq);
            }

        }
       // dd($newOptions);
        $product = Product::find($request->product_id);
        if($product){

            $variants = Variant::where('product_id',$product->id)->get();

            foreach($variants as $variant){
                $options = VariantAttribute::where('variant_id',$variant->id)->get('option_id');
                foreach($options as $option){
                    array_push($oldOptions,$option->option_id);
                }
              //  dd($oldOptions);
                $differenceArray = array_diff($newOptions, $oldOptions);
                if($differenceArray == []){
                    return Redirect::back()->withErrors(['msg' => 'These options already exist']);
                }
            }


        }


            if (isset($request->image)) {
                $name = Str::random(12);
                $image = $request->image;
                $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/Variant/', $imageName);
                $request->$image = 'uploads/Variant/' . $imageName;
            }

         $variant = Variant::create([
            'product_id'=>$request->product_id,
            'image' => $request->image,
            'price'=>$request->price,
            'discount'=>$request->discount,
         ]);


        foreach($request->except('_token') as $key =>$rq){
            if(is_int($key)){

                    VariantAttribute::create([
                        'variant_id'=>$variant->id,
                        'attribute_id'=>$key,
                        'option_id'=>$rq,
                    ]);



            }

        }
    return redirect('/admin/showvariant/' . $request->product_id);
    }


        public function show($id){


         $variants = Variant::where('product_id',$id)->get();

            return view('dashboard.views-dash.product.show', compact('variants','id'));


        }

    public function edit($id)
    {
        $variant = Variant::find($id);
        $product = $variant->product;
        $data = ProductAttribute::where('product_id','=',$product->id)->distinct('attribute_id')->get('attribute_id');

        $variantO = VariantAttribute::where('variant_id',$variant->id)->get();

        return view('dashboard.views-dash.variant.update',array('variant'=>$variant,'product'=>$product,'data'=>$data,'variantO'=>$variantO));


    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request,
            [
                'product_id' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,svg,gif',
                'price' => 'required',
               // 'discount' => 'required',
            ]);


        $variant = Variant::where('id',$id)->first();

        // Upload Images
        $img_name = $variant->image;
        if($request->hasFile('image')) {
            File::delete(public_path('uploads/variants/'.$variant->image));
            $img = $request->file('image');
            $img_name = rand(). time().$img->getClientOriginalName();
            $img->move(public_path('uploads/variants'), $img_name);
        }

         $variant->update([
            'price'=>$request->price,
            'image' => $img_name,
            'discount'=>$request->discount,
         ]);

        VariantAttribute::where('variant_id',$variant->id)->delete();
        foreach($request->except('_token') as $key =>$rq){
            if(is_int($key)){
                VariantAttribute::create([
                    'variant_id'=>$variant->id,
                    'attribute_id'=>$key,
                    'option_id'=>$rq,
                ]);

            }
        }

        return redirect('/admin/showvariant/'.$request->product_id);

    }

    public function destroy($id)
    {

        $variants = Variant::withoutGlobalScope(ActiveScope::class)->find($id);
        File::delete(public_path('uploads/variants/'.$variants->image));
        if ($variants) {
            VariantAttribute::where('variant_id',$id)->delete();
            $variants->delete();
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





}
