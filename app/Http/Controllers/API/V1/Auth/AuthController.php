<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\V1\Auth\AuthBaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SubmitCodeRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\AuthenticationService;
class AuthController extends AuthBaseController
{
    public function login(LoginRequest $loginRequest){
        return AuthenticationService::login($loginRequest->loginData());
    }

    public function register(RegisterRequest $registerRequest){
        return AuthenticationService::register($registerRequest->registerData());
    }

    public function submitCode(SubmitCodeRequest $submitCodeRequest){
        return AuthenticationService::submitCode($submitCodeRequest->validated());
    }

    public function show(){
        return AuthenticationService::show();
    }

    public function update(UpdateProfileRequest $updateProfileRequest){
        return AuthenticationService::update($updateProfileRequest->profileData());
    }

    public function destory(){
        return AuthenticationService::destory();
    }
}
