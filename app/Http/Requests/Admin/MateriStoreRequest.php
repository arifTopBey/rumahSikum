<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MateriStoreRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        return [
            
            'tipe_materi' => [
                'required',
                'string',
                'max:50',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,ppt,pptx,doc,docx,xls,xlsx,mp4,zip',
                'max:20480',
            ],

            'tautan' => [
                'nullable',
                'url',
                'max:500',
            ],
        ];
    }

    public function messages(): array
{
    return [
        'tipe_materi.required' => 'Tipe materi wajib dipilih.',
        'tipe_materi.string' => 'Tipe materi harus berupa teks.',
        'tipe_materi.in' => 'Tipe materi yang dipilih tidak valid.',

        'judul.required' => 'Judul materi wajib diisi.',
        'judul.string' => 'Judul materi harus berupa teks.',
        'judul.max' => 'Judul materi maksimal 255 karakter.',

        'deskripsi.string' => 'Deskripsi harus berupa teks.',

        'file.file' => 'File materi tidak valid.',
        'file.mimes' => 'File harus berformat PDF, PPT, PPTX, DOC, DOCX, XLS, XLSX, MP4, atau ZIP.',
        'file.max' => 'Ukuran file maksimal 20 MB.',
        'file.required_without' => 'File atau tautan wajib diisi minimal salah satu.',

        'tautan.url' => 'Tautan yang dimasukkan harus berupa URL yang valid.',
        'tautan.max' => 'Tautan maksimal 500 karakter.',
        'tautan.required_without' => 'File atau tautan wajib diisi minimal salah satu.',
    ];
}
}
