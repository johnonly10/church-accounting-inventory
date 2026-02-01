<?php

namespace App\Http\Requests\Revenue\RevenueCashCount;

use Illuminate\Foundation\Http\FormRequest;

class StoreRevenueCashCountRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'revenue_type_id' => ['required', 'integer', 'exists:revenue_types,id'],
            'bill_1000' => ['nullable', 'integer', 'min:0'],
            'bill_500'  => ['nullable', 'integer', 'min:0'],
            'bill_200'  => ['nullable', 'integer', 'min:0'],
            'bill_100'  => ['nullable', 'integer', 'min:0'],
            'bill_50'   => ['nullable', 'integer', 'min:0'],
            'bill_20'   => ['nullable', 'integer', 'min:0'],

            // Coins
            'coin_20' => ['nullable', 'integer', 'min:0'],
            'coin_10' => ['nullable', 'integer', 'min:0'],
            'coin_5'  => ['nullable', 'integer', 'min:0'],
            'coin_1'  => ['nullable', 'integer', 'min:0'],

            // Centavos
            'centimo_25' => ['nullable', 'integer', 'min:0'],
            'centimo_10' => ['nullable', 'integer', 'min:0'],
            'centimo_5'  => ['nullable', 'integer', 'min:0'],
            'centimo_1'  => ['nullable', 'integer', 'min:0'],
        ];
    }
}
