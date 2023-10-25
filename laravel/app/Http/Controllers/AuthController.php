<?php

namespace App\Http\Controllers;

use App\Executors\AuthExecutor;
use App\Http\Requests\Auth\AuthForgotPasswordRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthResetPasswordRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $executor;

    public function __construct()
    {
        $this->executor = new AuthExecutor();
    }

    public function login(AuthLoginRequest $request)
    {
        $result = $this->executor->login($request->validated());
        if (!$result) $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Logged in successfully', $result);
    }

    public function logout()
    {
        $this->executor->logout();
        return $this->responseSuccess('Logged out successfully');
    }

    public function me()
    {
        $result = $this->executor->me();
        return $this->responseSuccess('User data', $result);
    }

    public function register(AuthRegisterRequest $request)
    {
        $result = $this->executor->register($request->validated());
        if (!$result) $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Registered successfully', $result);
    }

    public function forgotPassword(AuthForgotPasswordRequest $request)
    {
        $result = $this->executor->forgotPassword($request->validated());
        if (!$result) $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Password reset successfully', $result);
    }

    public function resetPassword(AuthResetPasswordRequest $request)
    {
        $result = $this->executor->resetPassword($request->validated());
        if (!$result) $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Password reset successfully', $result);
    }
}
