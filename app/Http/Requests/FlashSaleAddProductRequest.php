<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlashSaleAddProductRequest extends FormRequest
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
            'product_id' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => 'required',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.unique' => 'The product is already in flash sale.'
        ];
    }

}
