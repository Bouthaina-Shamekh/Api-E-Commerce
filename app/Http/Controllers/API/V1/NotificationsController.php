<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function index()
    {
        $notifications = Auth::user()->notifications;
        return NotificationResource::collection($notifications)
        ->additional(['code' => 200 , 'status' => true ,'message' =>  Messages::getMessage('operation accomplished successfully')]);
    }


    public function update($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        $notification->markAsRead();
        return ControllersService::generateProcessResponse(false, 'UPDATE_SUCCESS', 400);
    }
}
