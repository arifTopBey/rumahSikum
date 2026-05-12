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

class AuthController extends Controller
{

    // protected $authRepository;
    // public function __construct(AuthInterface $authRepository)
    // {
    //     $this->authRepository = $authRepository;
    // }

    public function index()
    {
        return view('frontend.auth.index');
    }

    public function login(LoginSroreRequest $request){

        $validated = $request->validated();

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            // return redirect()->route('admin.sebaran.data.umkm');
            return redirect()->route('user.dashboard');
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




    public function registerStore(RegisterStoreRequest $request){

        $validated = $request->validated();
        DB::beginTransaction();

        try{

            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->status = 'active';
            $user->user_role = 'user';
            $user->password = bcrypt($validated['password']);
            $user->save();
            DB::commit();

            return redirect()->route('login')->with('success', 'Pendaftaran Berhasil Silahkan Login');
            
        }catch(Exception $e){
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
