<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|numeric|digits_between:9,15',
            'image_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'phone.numeric' => 'Nomor harus angka',
            'phone.digits_between' => 'Nomor tidak valid',
            'image_profile.image' => 'File harus berupa gambar',
            'image_profile.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
            'image_profile.max' => 'Ukuran maksimal 2MB',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ];
    }
}