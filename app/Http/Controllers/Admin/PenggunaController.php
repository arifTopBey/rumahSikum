<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index(){
        
        $users = User::orderByDesc('id')->get();
        return view('admin.pengguna.index', compact('users'));
    }
}
