<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'type'      => 'required|in:logo,background,background_2',
            'name'      => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'path'      => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ];
    }
}
