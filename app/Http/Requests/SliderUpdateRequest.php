<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'banner' =>[ 'nullable' , 'max:2000', 'image'],
            'type' => ['max:200'],
            'title' =>['max:500', 'required'],
            'starting_price' => ['max:200'],
            'btn_url' =>[ 'url'],
            'serial' => ['required'],
            'status' =>[ 'required'],
        ];
    }
}
