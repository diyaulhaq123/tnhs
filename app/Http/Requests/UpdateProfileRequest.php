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
            'title' => 'required|string|max:10',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'other_name' => 'nullable|string|max:20',
            'phone_number' => 'required|numeric|min:11',
            'gender' => 'required|string|max:10',
            'marital_status' => 'nullable|string|max:10',
            'nationality' => 'required|string|max:15',
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
