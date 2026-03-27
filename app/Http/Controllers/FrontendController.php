<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request){

        return view('frontend.beranda.index');
    }

    public function listPanel(){

        return view('frontend.panel.index');
    }

    public function eLearning(){

        return view('frontend.elearning.index');
    }

    public function eCommerce(){

        return view('frontend.ecommerce.index');
    }

    public function koperasi(){
        
        return view('frontend.koperasi.index');
    }
}
