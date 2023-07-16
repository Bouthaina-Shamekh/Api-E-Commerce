<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __invoke(ContactRequest $contactRequest)
    {
        return ContactService::store($contactRequest->contactData());
    }
}
