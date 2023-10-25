<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="AuthRegisterRequest",
 *     description="Auth register request",
 *     schema="AuthRegisterRequest",
 *     example={
 *         "name":"John Doe",
 *         "email":"email@mail.com",
 *         "password":"password",
 *         "password_confirmation":"password",
 *         "phone":"1234567890",
 *         "address":"Address 123"
 *     }
 * )
 */
class AuthResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:255|confirmed',
        ];
    }
}
