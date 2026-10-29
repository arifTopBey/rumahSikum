<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;
use App\Interface\AuthInterface;

class AuthRepositoryInterface implements AuthInterface
{
    
    protected $baseUrl;
    protected $sidtKey;

    public function __construct()
    {
        $this->baseUrl = config('services.sidt.url', env('SIDT_BASE_URL'));
        $this->sidtKey = config('services.sidt.key', env('SIDT_KEY'));
    }

    public function login(string $username, string $password){

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->asForm()->post($this->baseUrl . 'token', [
            'username' => $username,
            'password' => $password,
        ]);

        $data = $response->json();

        // Cek apakah API mengembalikan sukses sesuai struktur meta mereka
        if ($response->successful() && isset($data['data']['access_token'])) {
            return $data['data']; // Mengembalikan array berisi token
        }

        // Jika gagal, 
        return null;
    }   
    public function logout(){

        session()->forget(['api_token', 'user_data']);
    
        session()->flush();
    
        return true;
    }
}