<?php

namespace App\Http\Controllers;

use App\Http\Requests\CopounRequest;
use App\Models\Copoun;
use App\Models\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class CopounsController extends Controller
{

    public function index(Request $request)
    {
        if (!Gate::allows('copoun-view')) {
            abort(500);
        }
        if ($request->ajax()) {
            $data = Copoun::withoutGlobalScope(ActiveScope::class)->orderBy('id' , 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == 'ACTIVE') {
                        $status = '<button class="modal-effect btn btn-sm btn-success" style="margin: 5px" id="status" data-id="' . $row->id . '" ><i class=" icon-check"></i></button>';
                    } else {
                        $status = '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="status" data-id="' . $row->id . '" ><i class=" icon-check"></i></button>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditCopoun" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="showModalDeleteCopoun" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['status' => 'status', 'action' => 'action'])->make(true);
        }
        return view('dashboard.views-dash.copoun.index');
    }


    public function store(CopounRequest $copounRequest)
    {
        Copoun::create($copounRequest->validated());
        return ControllersService::responseSuccess(['message' => __('Added successfully') , 'status' => 200]);
    }


    public function edit($id)
    {
        $copoun = Copoun::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($copoun) {
            return ControllersService::responseSuccess([
                'message' => __('Found Data'),
                'status' => 200,
                'data' => $copoun
            ]);
        }
        return ControllersService::responseErorr([
            'message' => __('Not Found Data'),
            'status' => 400,
        ]);
    }


    public function update(CopounRequest $copounRequest, $id)
    {
        Copoun::withoutGlobalScope(ActiveScope::class)->find($id)->update($copounRequest->validated());
        return ControllersService::responseSuccess(['message' => __('updated successfully'),'status' => 200]);
    }


    public function destroy($id)
    {
        $copoun = Copoun::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($copoun) {
            $copoun->delete();
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
        $copoun = Copoun::withoutGlobalScope(ActiveScope::class)->find($id);
        if ($copoun) {
            $copoun->changeStatus();
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
