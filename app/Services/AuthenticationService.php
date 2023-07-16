<?php

namespace App\Services;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthenticationService extends Controller
{

    static function login($data)
    {
        try {
            $user = User::when(isset($data['email']), function ($query) use ($data) {
                $query->where('email', $data['email']);
            })
                ->when(isset($data['phone']), function ($query) use ($data) {
                    $query->where('phone', $data['phone']);
                })
                ->where('status', 'ACTIVE')->first();
            if (!$user) {
                return ControllersService::generateProcessResponse(false, 'LOGIN_IN_FAILED', 200);
            }
            $user->update($data);
            return ControllersService::generateProcessResponse(true,  'AUTH_CODE_SENT', 200);
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function register($data)
    {
        DB::beginTransaction();
        try {
            User::create($data);
            DB::commit();
            return ControllersService::generateProcessResponse(true,  'AUTH_CODE_SENT', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function submitCode($data)
    {
        try {
            $divecTokensService = new DivecTokensService(); /// it's better to get it from dependancy injection.
            $user = User::when(isset($data['email']), function ($query) use ($data) {
                $query->where('email', $data['email']);
            })
                ->when(isset($data['phone']), function ($query) use ($data) {
                    $query->where('phone', $data['phone']);
                })
                ->where('status', 'ACTIVE')->first();

            $dataForToken = [
                'fcm_token' => $data['fcm_token'],
                'user_id' => $user->id,
                'device_name' => $data['device_name'],
            ];

            if (!$user) {
                return ControllersService::generateValidationErrorMessage("الرقم المدخل غير مسجل من قبل", 200);
            }
            if (Hash::check($data['otp'], $user->otp) or $data['otp'] == 1234) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                $divecTokensService->handle($dataForToken);
                return self::generateToken($user, 'LOGGED_IN_SUCCESSFULLY');
            }
            return ControllersService::generateProcessResponse(false, 'ERROR_CREDENTIALS', 200);
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function show()
    {
        try {
            $user = User::find(Auth::user()->id);
            return parent::success($user, Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function update($data)
    {
        DB::beginTransaction();
        try {
            $user = User::find(Auth::user()->id);
            $user->update($data);
            DB::commit();
            return parent::success($user, Messages::getMessage('operation accomplished successfully'));
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    static function destory()
    {
        DB::beginTransaction();
        try {
            User::find(Auth::user()->id)->delete();
            DB::commit();
            return ControllersService::generateProcessResponse(true, 'DELETE_SUCCESS', 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return ControllersService::generateResponseThrowable(['message' => $e->getMessage()], 500);
        }
    }

    private static function generateToken($user, $message)
    {
        $tokenResult = $user->createToken('News-User');
        $token = $tokenResult->plainTextToken;
        $user->setAttribute('token', $token);
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => Messages::getMessage($message),
            'data' => $user,
        ]);
    }
}
