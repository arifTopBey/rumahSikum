<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AcaraStoreRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kategori_acara_id' => 'required|exists:kategori_acara,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_acara' => 'required|date',
            'waktu_acara_mulai' => 'nullable|date_format:H:i',
            'waktu_acara_selesai' => 'nullable|date_format:H:i|after:waktu_acara_mulai',
            'kuota' => 'nullable|integer|min:0',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ];
    }
}
