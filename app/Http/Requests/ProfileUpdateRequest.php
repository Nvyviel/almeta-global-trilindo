<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_phone_number' => ['nullable', 'string', 'max:20'],
            'company_location' => ['nullable', 'string', 'max:255'],
            'company_address' => ['nullable', 'string', 'max:500'],
            'ktp' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'npwp' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'nib' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
