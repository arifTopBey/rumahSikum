<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class ProdukUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_produk' => 'nullable|string|max:255',

            'harga' => 'nullable|numeric|min:0',

            'stok' => 'nullable|integer|min:0',

            'produk_deskripsi' => 'nullable|string',

            'kategori_produk_id' => 'nullable|exists:kategori_produk,id',

            'status_produk' => 'nullable|in:0,1',

            'produk_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'photos_produks' => 'nullable|array',

            'photos_produks.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            
            'kategori_produk_id.exists' => 'Kategori tidak valid.',

            'produk_thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'produk_thumbnail.mimes' => 'Thumbnail harus format jpg, jpeg, png, atau webp.',
            'produk_thumbnail.max' => 'Ukuran thumbnail maksimal 2 MB.',

            'photos_produks.*.image' => 'Foto tambahan harus berupa gambar.',
            'photos_produks.*.mimes' => 'Foto tambahan harus format jpg, jpeg, png, atau webp.',
            'photos_produks.*.max' => 'Ukuran foto tambahan maksimal 2 MB.',
        ];
    }
}
