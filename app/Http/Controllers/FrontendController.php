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

    public function eCommerceDetail(){

        return view('frontend.ecommerce.detailProduk');
    }
    public function cartList(){

        return view('frontend.ecommerce.cartList');
    }

    public function koperasi(){
        
        return view('frontend.koperasi.index');
    }

    public function tambahUmkm(){
        return view('frontend.daftarUMKM.index');
    }


}
