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
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'other_name' => 'nullable|string',
            'phone_number' => 'required|numeric|min:11',
            'gender' => 'required|string',
            'marital_status' => 'nullable|string',
            'nationality' => 'required|string',
            'state' => 'required|integer',
            'lga' => 'required|integer',
            'town' => 'nullable|string',
            'date_of_birth' => 'required',
            'place_of_birth' => 'nullable|string',
            'membership_category_id' => 'required|integer',
            'involved_in_hypertension' => 'required|string',
            'hypertension_description' => 'nullable|required_if:involved_in_hypertension,Yes|string',
        ];
    }
}
