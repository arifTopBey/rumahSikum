<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ElearningStoreRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //  id BIGINT AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(255),
    // kategori_elearning_id BIGINT,
    // deskripsi TEXT,
    // views BIGINT NOT NULL DEFAULT 0,
    // pdf VARCHAR(255),
    // thumbnail VARCHAR(255),
    // link_youtube VARCHAR(255),
    // nama_mentor VARCHAR(255),
    // photo_mentor VARCHAR(255),
    // bidang_menthor VARCHAR(255),
    // is_publish TINYINT(1) NOT NULL DEFAULT 1,
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'kategori_elearning_id' => 'required|exists:kategori_elearning,id',
            'deskripsi' => 'required|string|max:510',
            'pdf' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'link_youtube' => 'required|string|max:255',
            'nama_mentor' => 'required|string|max:255',
            'photo_mentor' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'bidang_menthor' => 'required|string|max:255',
            'is_publish' => 'nullable',
            'durasi' => 'required',
            'level' => 'required|in:semua level,pemula,mahir',
        ];
    }
}
