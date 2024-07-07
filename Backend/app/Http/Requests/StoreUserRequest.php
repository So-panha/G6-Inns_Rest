<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phoneNumber' => 'nullable|string|max:20',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'password.reqired' => 'Password is required!',
            'email.required' => 'Email is required!',
            'phoneNumber.required' => 'Phone number is required!',
            'profile.required' => 'Profile image is required!',
        ];
    }
}
