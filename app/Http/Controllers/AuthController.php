<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginSroreRequest;
use App\Interface\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // protected $authRepository;
    // public function __construct(AuthInterface $authRepository)
    // {
    //     $this->authRepository = $authRepository;
    // }

    public function index()
    {
<<<<<<< HEAD
        return view('frontend.auth.index');
=======
        return view('frontend.index');
>>>>>>> 501705a6b2991e5e8265c1a4070acd87d8b9c04a
    }

    public function login(LoginSroreRequest $request){

        $validated = $request->validated();

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            return redirect()->route('admin.sebaran.data.umkm');
        } 

        return back()->with('LoginError','Email Atau Password Salah');

    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()->route('login');
    }

    // login dan logout menggunakan repository
    // public function login(LoginSroreRequest $request)
    // {


    //     $validated = $request->validated();


    //     $result = $this->authRepository->login($validated['username'], $validated['password']);

    //     // dd($result); 

    //     if ($result && isset($result['access_token'])) {
    //         session([
    //             'api_token' => $result['access_token'],
    //             'user_data' => $result['user'] ?? null // Simpan data user jika ada
    //         ]);
            
    //         return redirect()->route('admin.ukmkm.list')->with('success', 'Selamat Datang!');
    //     }

    //     return back()->withErrors(['message' => 'Kredensial tidak valid. Silakan cek kembali username dan password Anda.'])
    //                 ->withInput();
    //     }
    
    // public function logout(){
    //     $this->authRepository->logout();

    //     return redirect()->route('login')
    //         ->with('success', 'Anda telah berhasil keluar.');
    // }
}
