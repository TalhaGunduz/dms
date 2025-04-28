<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->id,
            'password' => 'required',


        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı zorunkludur',
            'email.unique' => 'Bu email kullanılıyor.',
            'email.required' => 'Email alanı zorunludur',
            'password.required' => 'Şifre alanı zorunkludur',

        ];
    }
}
