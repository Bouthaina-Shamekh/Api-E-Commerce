<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Scopes\ActiveScope;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactsController extends Controller
{

    public function index(Request $request)
    {
        if (!Gate::allows('contact-view')) {
            abort(500);
        }
        if ($request->ajax()) {
            $data = Contact::with('user')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="showModalDeleteContact" data-name="' . $row->title . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action' => 'action'])->make(true);
        }
        return view('dashboard.views-dash.contact.index');
    }


    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
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


     public function contact() {

        Mail::to('admin@gmail.com')->send(new TestMail());
        return 'Done';



    }

}
