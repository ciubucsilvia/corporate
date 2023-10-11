<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasPermissionTo('Create Portfolio');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:150',
            'image' => 'required|mimes:jpg,png|max:1024',
            'category_id' => 'integer',
            'content' => 'max:500',
        ];
    }
}
