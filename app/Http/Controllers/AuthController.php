<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginSroreRequest;
use App\Http\Requests\RegisterStoreRequest;
use App\Interface\AuthInterface;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    // protected $authRepository;
    // public function __construct(AuthInterface $authRepository)
    // {
    //     $this->authRepository = $authRepository;
    // }

    public function index(Request $request)
    {
         $throttleKey = '';

        if ($request->old('email')) {
            $throttleKey = strtolower($request->old('email')) . '|' . $request->ip();
        }

        $lockoutSeconds = 0;

        if ($throttleKey && RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $lockoutSeconds = RateLimiter::availableIn($throttleKey);
        }

        return view('frontend.auth.index', compact('lockoutSeconds'));
    }

    public function login2(LoginSroreRequest $request)
    {

        $validated = $request->validated();

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            // return redirect()->route('admin.sebaran.data.umkm');
            return redirect()->route('user.dashboard');
        }

        return back()->with('LoginError', 'Email Atau Password Salah');
    }
    public function login(LoginSroreRequest $request)
    {
        $validated = $request->validated();

        // Key unik berdasarkan email dan IP
        $throttleKey = Str::lower($request->email) . '|' . $request->ip();

        // Maksimal 5 percobaan login
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {

            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->withErrors([
                    'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
                ])
                ->with('lockout_seconds', $seconds)
                ->withInput($request->only('email'));
        }

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            RateLimiter::clear($throttleKey);

            return redirect()->route('user.dashboard');
        }

        // Tambah hitungan gagal login
        RateLimiter::hit($throttleKey, 300); 

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.'
            ])
            ->withInput($request->only('email'));
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()->route('login');
    }
    public function registerStore(RegisterStoreRequest $request)
    {

        $validated = $request->validated();
        DB::beginTransaction();

        try {

            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->status = 'active';
            $user->user_role = 'user';
            $user->password = bcrypt($validated['password']);
            $user->save();
            DB::commit();

            return redirect()->route('login')->with('success', 'Pendaftaran Berhasil Silahkan Login');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('frontend.register')->with('failed', $e->getMessage());
        }
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
