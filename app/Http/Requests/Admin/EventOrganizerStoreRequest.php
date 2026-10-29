<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventOrganizerStoreRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'judul_event' => ['required', 'string', 'max:255'],
            'kategori_organizer_id' => ['required', 'integer', 'exists:kategori_event_organizers,id'],
            'waktu_mulai' => ['required', 'date', 'after_or_equal:now'],
            'waktu_selesai' => ['required', 'date', 'after:waktu_mulai'],
            'jenis_pelatihan' => ['required', 'in:online,webinar,workshop,bootcamp,offline'],
            
            // Validasi Kondisional: Wajib diisi jika jenis pelatihan adalah offline
            'nama_venue' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string', 'max:255'],
            'kota' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string', 'max:100'],
            'provinsi' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string', 'max:100'],
            'alamat_lengkap' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string'],

            'kuota_peserta' => ['nullable', 'integer', 'min:0'],
            'deskripsi_event' => ['nullable', 'string'],
            'banner_event' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
            'is_publish' => 'nullable',
        ];
    }

    public function messages(): array
{
    return [
        'judul_event.required' => 'Judul event wajib diisi.',
        'judul_event.string' => 'Judul event harus berupa teks.',
        'judul_event.max' => 'Judul event maksimal 255 karakter.',

        'kategori_organizer_id.required' => 'Kategori organizer wajib dipilih.',
        'kategori_organizer_id.integer' => 'Kategori organizer tidak valid.',
        'kategori_organizer_id.exists' => 'Kategori organizer yang dipilih tidak tersedia.',

        'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
        'waktu_mulai.date' => 'Format waktu mulai tidak valid.',
        'waktu_mulai.after_or_equal' => 'Waktu mulai tidak boleh sebelum waktu sekarang.',

        'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
        'waktu_selesai.date' => 'Format waktu selesai tidak valid.',
        'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',

        'jenis_pelatihan.required' => 'Jenis pelatihan wajib dipilih.',
        'jenis_pelatihan.in' => 'Jenis pelatihan yang dipilih tidak valid.',

        'nama_venue.required_if' => 'Nama venue wajib diisi untuk pelatihan offline.',
        'nama_venue.string' => 'Nama venue harus berupa teks.',
        'nama_venue.max' => 'Nama venue maksimal 255 karakter.',

        'kota.required_if' => 'Kota wajib diisi untuk pelatihan offline.',
        'kota.string' => 'Kota harus berupa teks.',
        'kota.max' => 'Kota maksimal 100 karakter.',

        'provinsi.required_if' => 'Provinsi wajib diisi untuk pelatihan offline.',
        'provinsi.string' => 'Provinsi harus berupa teks.',
        'provinsi.max' => 'Provinsi maksimal 100 karakter.',

        'alamat_lengkap.required_if' => 'Alamat lengkap wajib diisi untuk pelatihan offline.',
        'alamat_lengkap.string' => 'Alamat lengkap harus berupa teks.',

        'kuota_peserta.integer' => 'Kuota peserta harus berupa angka.',
        'kuota_peserta.min' => 'Kuota peserta minimal 0.',

        'deskripsi_event.string' => 'Deskripsi event harus berupa teks.',

        'banner_event.image' => 'Banner event harus berupa gambar.',
        'banner_event.mimes' => 'Banner event harus berformat JPEG, PNG, JPG, atau WEBP.',
        'banner_event.max' => 'Ukuran banner event maksimal 2 MB.',
    ];
}
}
