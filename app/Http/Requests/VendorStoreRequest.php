<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shop_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'identity_number' => 'required|max:16',
            'name' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kategori_produk_id' => 'required|exists:kategori_produk,id',
            'kode_pos' => 'required|string|max:10',
            'shop_address' => 'required|string',
            'kab_kota' => 'required|string|max:255',
            'store_photo' => 'required|image|mimes:png,jpg,jpeg',
            'identity_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
