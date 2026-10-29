<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdressStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ubah kalau butuh auth tertentu
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'label_name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'email'     => 'required|email|max:255',
            'kecamatan' => 'required|string|max:255',
            'zip'       => 'required|string|max:10',
            'address'   => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'   => 'User wajib diisi',
            'name.required'      => 'Nama wajib diisi',
            'label_name.required'      => 'Label nama wajib diisi',
            'phone.required'     => 'Nomor telepon wajib diisi',
            'email.required'     => 'Email wajib diisi',
            'email.email'        => 'Format email tidak valid',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'zip.required'       => 'Kode pos wajib diisi',
            'address.required'   => 'Alamat wajib diisi',
        ];
    }
}