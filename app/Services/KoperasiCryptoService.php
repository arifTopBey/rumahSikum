<?php

namespace App\Services;

class KoperasiCryptoService
{
    /**
     * Fungsi untuk enkripsi data sebelum dikirim ke API Kemenkop
     */
    public function encryptData($data)
    {
        $sharedKey = env('SHARED_SECRET_KEY');
        $sharedKeyIV = env('SHARED_SECRET_KEY_IV');
        
        $data = is_array($data) ? json_encode($data) : $data;
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $sharedKey, 0, $sharedKeyIV);
        
        return $encrypted;
    }

    /**
     * Fungsi untuk dekripsi response acak yang didapat dari API Kemenkop
     */
    public function decryptData($data, $type = 'string')
    {
        $sharedKey = env('SHARED_SECRET_KEY');
        $sharedKeyIV = env('SHARED_SECRET_KEY_IV');
        
        $decrypted = openssl_decrypt($data, 'AES-256-CBC', $sharedKey, 0, $sharedKeyIV);
        
        return $type === 'json' ? json_decode($decrypted, true) : $decrypted;
    }
}