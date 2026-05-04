<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarPesananController extends Controller
{
    public function index(Request $request, $id){
        
        return view('admin.pesanan.index');
    }
}
