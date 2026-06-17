<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class RegisterStoreRequest extends FormRequest
{
    public function rules(): array
{
    return [
        'name' => 'required|string|max:255',

        'email' => 'required|email|max:255|unique:users,email',

        'password' => [
            'required',
            'confirmed',
            Password::min(12)
                ->mixedCase()     // Huruf besar & kecil
                ->numbers()       // Minimal 1 angka
                ->symbols()       // Minimal 1 simbol
                ->uncompromised() // Cek password bocor/common password
        ],
    ];
}

    /**
     * Custom validation messages
     */
   public function messages(): array
{
    return [
        // Name
        'name.required' => 'Nama lengkap wajib diisi.',
        'name.string' => 'Nama lengkap harus berupa teks.',
        'name.max' => 'Nama lengkap maksimal 255 karakter.',

        // Email
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',
        'email.unique' => 'Email sudah terdaftar.',

        // Password
        'password.required' => 'Password wajib diisi.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password.min' => 'Password minimal 12 karakter.',
        'password.mixed' => 'Password harus mengandung huruf besar dan huruf kecil.',
        'password.numbers' => 'Password harus mengandung minimal satu angka.',
        'password.symbols' => 'Password harus mengandung minimal satu simbol.',
        'password.uncompromised' => 'Password terlalu umum atau pernah bocor, gunakan password lain.',
    ];
}

}
