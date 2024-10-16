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

        return [
            'name' => 'required|max:255|min:5',
            'email' => 'required|email|unique:profiles,email,' . $profileId . '|max:255|min:10',
            'bio' => 'required|max:655|min:10',
            'password' => 'sometimes|confirmed|max:255|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500240',
        ];
    }
}
