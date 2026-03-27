<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoperasiController extends Controller
{
    public function index(){

        return view('admin.koperasi.index');
    }

    public function show(){
        return view('admin.koperasi.detail');
    }

    


}
