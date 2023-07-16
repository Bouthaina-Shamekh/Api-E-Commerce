<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Models\Setting;
use Throwable;

class SettingService extends Controller
{
    static function index($data)
    {
        try {
            $setting = Setting::when(isset($data['key']), function ($q) use ($data) {
                $q->where('key', $data['key']);
            })->get();
            return parent::success($setting, Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }
}
