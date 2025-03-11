<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            // 'user_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'other_name' => 'sometimes',
            'phone_number' => 'required|min:11',
            'gender' => 'required',
            'marital_status' => 'sometimes',
            'nationality' => 'required',
            'state' => 'required|integer',
            'lga' => 'required|integer',
            'town' => 'sometimes|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'sometimes',
            'date_of_birth' => 'required',
            'place_of_birth' => 'sometimes',
        ];
    }
}
