<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
    $profileId = $this->route('profile') ? $this->route('profile')->id : null;

    $rules = [
        'name' => 'required|max:255|min:5',
        'email' => 'required|email|unique:profiles,email,' . $profileId . '|max:255|min:10',
        'bio' => 'required|max:655|min:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500240',
        'location' => 'nullable|string|max:255',
        'occupation' => 'nullable|string|max:255',
        'university' => 'nullable|string|max:255',
    ];

    // Check if the request is for storing or updating
    if ($this->isMethod('post')) {
        // Store (sign-up) rules
        $rules['password'] = 'required|confirmed|max:255|min:10'; // Password is required during sign-up
    } else if ($this->isMethod('put') || $this->isMethod('patch')) {
        // Update profile rules
        $rules['password'] = 'nullable|confirmed|max:255|min:10'; // Password is optional during update
    }

    return $rules;
}

    
}
