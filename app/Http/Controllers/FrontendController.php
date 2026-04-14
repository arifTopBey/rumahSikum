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
        $acaras = \App\Models\Acara::where('tanggal_acara', '>=', now())->latest()->paginate(6);
        return view('frontend.acara.index', compact('acaras'));
    }

    public function detailAcara($id){
        $acara = \App\Models\Acara::findOrFail($id);
        return view('frontend.acara.detailAcara', compact('acara'));
    }

    public function pelatihan(){
        return view('frontend.pelatihan.index');
    }

    public function detailPelatihan(){
        return view('frontend.pelatihan.detailPelatihan');
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

    public function detailEdukasiKeuangan(){
        return view('frontend.edukasiKeuangan.detail');
    }

    public function berita(){
        $beritas = \App\Models\Berita::where('is_published', 1)->latest()->paginate(10);
        return view('frontend.berita.index', compact('beritas'));
    }

    public function detailBerita(){
        return view('frontend.berita.detailBerita');
    }


}
