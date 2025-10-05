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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nickname' => [
                'required',
                'string',
                'max:50',
                'min:3',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif',
                'max:2048', // 2MB max
            ],
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nickname.required' => 'Nickname is required.',
            'nickname.unique' => 'This nickname is already taken.',
            'nickname.min' => 'Nickname must be at least 3 characters.',
            'nickname.max' => 'Nickname must not exceed 50 characters.',
            'nickname.regex' => 'Nickname can only contain letters, numbers, hyphens and underscores.',
            'profile_picture.image' => 'Profile picture must be an image.',
            'profile_picture.mimes' => 'Profile picture must be a JPG, PNG, or GIF file.',
            'profile_picture.max' => 'Profile picture must be less than 2MB.',
        ];
    }
}
