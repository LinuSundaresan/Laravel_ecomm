<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorProductRequest extends FormRequest
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
            'thumb_image' =>['required','max:200', 'image'],
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'sub_category_id' => ['nullable'],
            'child_category_id' => ['nullable'],
            'brand_id' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required' , 'max:600'],
            'long_description'  => ['required'],
            'product_type' => ['required'],
            'status' => ['required'],
            'seo_title' => ['nullable' , 'max:250'],
            'seo_description' => ['nullable', 'max:2500'],
        ];
    }
}
