<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class ProdukStoreRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string|max:255',

            'harga' => 'required|numeric|min:0',

            'stok' => 'required|integer|min:0',

            'produk_deskripsi' => 'nullable|string',

            'kategori_produk_id' => 'required|exists:kategori_produk,id',

            'status_produk' => 'required|in:0,1',

            'produk_thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'photos_produks' => 'nullable|array',

            'photos_produks.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'stok.required' => 'Stok produk wajib diisi.',
            'kategori_produk_id.required' => 'Kategori produk wajib dipilih.',
            'kategori_produk_id.exists' => 'Kategori tidak valid.',
            'produk_thumbnail.required' => 'Thumbnail produk wajib diupload.',

            'produk_thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'produk_thumbnail.mimes' => 'Thumbnail harus format jpg, jpeg, png, atau webp.',
            'produk_thumbnail.max' => 'Ukuran thumbnail maksimal 2 MB.',

            'photos_produks.*.image' => 'Foto tambahan harus berupa gambar.',
            'photos_produks.*.mimes' => 'Foto tambahan harus format jpg, jpeg, png, atau webp.',
            'photos_produks.*.max' => 'Ukuran foto tambahan maksimal 2 MB.',
        ];
    }
}
