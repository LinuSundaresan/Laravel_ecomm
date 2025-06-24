<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RazorpaySettingUpdateRequest extends FormRequest
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
            'status'    =>  ['required','integer'],
            'country_name' =>  ['required','max:200'],
            'currency_name' => ['required','max:200'],
            'currency_rate' =>  ['required'],
            'razorpay_key' => ['required'],
            'razorpay_secret_key' => ['required'],
        ];
    }
}
