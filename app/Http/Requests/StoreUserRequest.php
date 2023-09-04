<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'registrationNumber' => [
                'required',
                Rule::unique('users')->ignore($this->user()->id)
            ],
                "name" => 'required|max:100',
                "birthDate" => 'required',
                "password" => 'required|min:8',
                "recruitmentDate" => 'required',
                "sex" => 'required',
                "role" => 'required',
                "nationality" => 'required',
                'birthPlace' => 'required'
        ];
    }
}
