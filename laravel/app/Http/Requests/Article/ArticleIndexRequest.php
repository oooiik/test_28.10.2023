<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'created_user_ids' => 'array',
            'created_user_ids.*' => 'integer|exists:users,id,deleted_at,NULL',
            'created_at_from' => 'date|before:created_at_to',
            'created_at_to' => 'date|after:created_at_from'
        ];
    }
}
