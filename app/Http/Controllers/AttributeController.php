<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Category;
use App\Models\Attribute;
use Yajra\DataTables\DataTables;
use App\Models\Scopes\ActiveScope;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('attribute-view')) {
            abort(500);
        }
        if ($request->ajax()) {
            $data = Attribute::withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditAttribute" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="showModalDeleteAttribute" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action' => 'action'])->make(true);
        }
        return view('dashboard.views-dash.attribute.index');
    }

    public function store(Request $attributeRequest)
    {


        $attr = Attribute::create([
            'title_ar'=>$attributeRequest->title_ar,
            'title_en'=>$attributeRequest->title_en,
        ]);

        return ControllersService::responseSuccess(['message' => __('Added successfully') , 'status' => 200]);
    }

    public function edit($id)
    {
        $attribute = Attribute::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($attribute) {
            return ControllersService::responseSuccess([
                'message' => __('Found Data'),
                'status' => 200,
                'data' => $attribute
            ]);
        }
        return ControllersService::responseErorr([
            'message' => __('Not Found Data'),
            'status' => 400,
        ]);
    }

    public function update(AttributeRequest $attributeRequest, $id)
    {
        Attribute::withoutGlobalScope(ActiveScope::class)->find($id)->update($attributeRequest->attributeData());
        return ControllersService::responseSuccess(['message' => __('updated successfully'),'status' => 200]);
    }

    public function destroy($id)
    {
        $attribute = Attribute::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($attribute) {
            $attribute->delete();
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
