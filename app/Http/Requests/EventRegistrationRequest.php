<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
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

            'no_hp' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'jenis_usaha' => [
                'required',
                'string',
                'max:100',
            ],

            'nama_usaha' => [
                'required',
                'string',
                'max:255',
            ],

            'lokasi_merchant' => [
                'required',
                'string',
            ],

            'pendapatan_bulanan' => [
                'required',
                'string',
                'max:100',
            ],
        ];
    }

    public function messages(): array
{
    return [
        'nama.required' => 'Nama wajib diisi.',
        'nama.string' => 'Nama harus berupa teks.',
        'nama.max' => 'Nama maksimal 255 karakter.',

        'no_hp.required' => 'Nomor HP wajib diisi.',
        'no_hp.string' => 'Nomor HP harus berupa teks.',
        'no_hp.max' => 'Nomor HP maksimal 20 karakter.',

        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',

        'alamat.required' => 'Alamat wajib diisi.',
        'alamat.string' => 'Alamat harus berupa teks.',

        'jenis_usaha.required' => 'Jenis usaha wajib diisi.',
        'jenis_usaha.string' => 'Jenis usaha harus berupa teks.',
        'jenis_usaha.max' => 'Jenis usaha maksimal 100 karakter.',

        'nama_usaha.required' => 'Nama usaha wajib diisi.',
        'nama_usaha.string' => 'Nama usaha harus berupa teks.',
        'nama_usaha.max' => 'Nama usaha maksimal 255 karakter.',

        'lokasi_merchant.required' => 'Lokasi merchant wajib diisi.',
        'lokasi_merchant.string' => 'Lokasi merchant harus berupa teks.',

        'pendapatan_bulanan.required' => 'Pendapatan per bulan wajib dipilih.',
        'pendapatan_bulanan.string' => 'Pendapatan per bulan tidak valid.',
        'pendapatan_bulanan.max' => 'Pendapatan per bulan maksimal 100 karakter.',
    ];
}
}
