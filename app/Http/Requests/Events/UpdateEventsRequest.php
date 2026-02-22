<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventsRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description'       => 'required|string|max:1000',
            'start_at'          => 'required|date',
            'ends_at'           => 'required|date|after:start_at',
            'location'          => 'required|string|max:255',
            'image_path'        => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'remove_image'      => 'nullable|in:0,1',
        ];
    }
}
