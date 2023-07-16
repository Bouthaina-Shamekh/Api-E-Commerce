<?php

namespace App\Services;

use App\Http\Controllers\ControllersService;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContactService
{

    static function store($data)
    {
        DB::beginTransaction();
        try {
            Contact::create($data);
            DB::commit();
            return ControllersService::generateProcessResponse(true, 'CREATE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
