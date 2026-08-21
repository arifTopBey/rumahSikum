<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NarasumberStoreRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    return [
        'nama' => [
            'required',
            'string',
            'max:255',
        ],

        'keahlian_jabatan' => [
            'nullable',
            'string',
            'max:255',
        ],

        'bio' => [
            'nullable',
            'string',
        ],

        'foto' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png',
            'max:2048',
        ],
    ];
    }

    public function messages(): array
{
    return [
        'nama.required' => 'Nama narasumber wajib diisi.',
        'nama.string' => 'Nama narasumber harus berupa teks.',
        'nama.max' => 'Nama narasumber maksimal 255 karakter.',

        'keahlian_jabatan.string' => 'Keahlian atau jabatan harus berupa teks.',
        'keahlian_jabatan.max' => 'Keahlian atau jabatan maksimal 255 karakter.',

        'bio.string' => 'Bio narasumber harus berupa teks.',

        'foto.image' => 'File foto harus berupa gambar.',
        'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG',
        'foto.max' => 'Ukuran foto maksimal 2 MB.',
    ];
}
}
