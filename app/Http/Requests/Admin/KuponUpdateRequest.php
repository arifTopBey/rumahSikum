<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KuponUpdateRequest extends FormRequest
{
   
     public function rules(): array
    {
        return [
            'nama_kupon' => 'required|string|max:255',

            'code_kupon' => 'required|string|max:255',
        // 'code_kupon' =>     [
        //         'required',
        //         'string',
        //         'max:255',
        //         Rule::unique('kupons', 'code_kupon')->ignore($this->kupon),
        //     ],

            'diskon_value' => 'required|integer|min:1',

            'status_kupon' => 'nullable|boolean',

            'max_use' => 'required|integer|min:1',

            'tanggal_mulai' => 'required|date',

            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kupon.required' => 'Nama kupon wajib diisi.',

            'code_kupon.required' => 'Kode kupon wajib diisi.',
            // 'code_kupon.unique' => 'Kode kupon sudah digunakan.',

            'diskon_value.required' => 'Diskon wajib diisi.',
            'diskon_value.integer' => 'Diskon harus berupa angka.',
            'diskon_value.min' => 'Diskon minimal 1.',

            'max_use.required' => 'Maksimal penggunaan wajib diisi.',
            'max_use.integer' => 'Maksimal penggunaan harus berupa angka.',
            'max_use.min' => 'Maksimal penggunaan minimal 1.',

            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',

            'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
        ];
    }
}
