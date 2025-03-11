<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProfileRequest extends FormRequest
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
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' =>'required',
            'other_name' =>'required',
            'gender' =>'required',
            'marital_status' =>'required',
            'nationality' =>'required',
            'state' =>'required',
            'lga' =>'required',
            'town' =>'required',
            'address_line_1' =>'required',
            'address_line_2' =>'required',
            'date_of_birth' =>'required',
            'place_of_birth' =>'required',
        ];
    }
}
