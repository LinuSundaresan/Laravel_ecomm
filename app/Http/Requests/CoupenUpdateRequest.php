<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoupenUpdateRequest extends FormRequest
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
            'name' => ['required','max:200'],
            'code' => ['required','max:200'],
            'quantity' => ['required','integer'],
            'max_use' =>['required','integer'],
            'start_date' =>['required','date'],
            'end_date' =>['required','date'],
            'discount_type' =>['required','max:200'],
            'discount' =>['required','integer'],
            'status' =>['required','integer'],
        ];
    }
}
