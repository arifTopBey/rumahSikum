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

    // nanti memakai id
    public function toko(){

        return view('frontend.ecommerce.toko.index');

    }

    public function alamatSaya(){
        return view('frontend.alamat.index');
    }


    public function checkout(){
        return view('frontend.checkout.index');
    }

    public function ulasan(){
        return view('frontend.ecommerce.ulasan');
    }

    public function transaksiDetail(){
        return view('frontend.ecommerce.detailTransaksi');
    }

    public function acara(){
        return view('frontend.acara.index');
    }

    public function detailAcara(){
        return view('frontend.acara.detailAcara');
    }

    public function pelatihan(){
        return view('frontend.pelatihan.index');
    }

    public function daftarPelatihan(){
        return view('frontend.pelatihan.daftarPelatihan');
    }

    public function informasiBPOM(){
        return view('frontend.informasiBPOM.index');
    }

    public function edukasiKeuangan(){
        return view('frontend.edukasiKeuangan.index');
    }


}
