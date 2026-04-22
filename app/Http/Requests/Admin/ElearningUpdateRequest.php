<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ElearningUpdateRequest extends FormRequest
{
   
 public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'kategori_elearning_id' => 'required|exists:kategori_elearning,id',
            'deskripsi' => 'required|string',

            // FILE (OPTIONAL SAAT UPDATE)
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120',
            'photo_mentor' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // FIELD LAIN
            'link_youtube' => 'nullable|url',
            'nama_mentor' => 'nullable|string|max:255',
            'bidang_menthor' => 'nullable|string|max:255',
            'durasi' => 'nullable|integer|min:1',
            'level' => 'required|in:semua level,pemula,mahir',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Judul wajib diisi',
            'kategori_elearning_id.required' => 'Kategori wajib dipilih',
            'deskripsi.required' => 'Deskripsi wajib diisi',

            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'pdf.mimes' => 'File harus berupa PDF',
            'photo_mentor.image' => 'Foto mentor harus berupa gambar',

            'link_youtube.url' => 'Link harus berupa URL valid',
            'durasi.integer' => 'Durasi harus berupa angka',
        ];
    }
}
