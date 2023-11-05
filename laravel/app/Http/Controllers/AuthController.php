<?php

namespace App\Http\Controllers;

use App\Executors\AuthExecutor;
use App\Http\Requests\Auth\AuthForgotPasswordRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthExecutor $executor)
    {
    }

    public function login(AuthLoginRequest $request)
    {
        $result = $this->executor->login($request->validated());
        if (!$result) return $this->responseUnauthorized('Invalid credentials');
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
        if (!$result) return $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Registered successfully', $result);
    }

    public function forgotPassword(AuthForgotPasswordRequest $request)
    {
        $result = $this->executor->forgotPassword($request->validated());
        if (!$result) return $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Password reset successfully', $result);
    }

    public function resetPassword(AuthResetPasswordRequest $request)
    {
        $result = $this->executor->resetPassword($request->validated());
        if (!$result) return $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Password reset successfully', $result);
    }

    public function verifyEmail(Request $request)
    {
        $user = User::findOrFail($request->route('id'));
        $hash = $request->route('hash');
        $result = $this->executor->verifyEmail($user, $hash);
        if (!$result) return view('auth.not-verified-email');
        return view('auth.verified-email');
    }
}
