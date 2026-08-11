<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Berita;
use App\Models\Elearning;
use App\Models\KategoriPelatihan;
use App\Models\KategoriProduk;
use App\Models\Pelatihan;
use App\Models\PopupBanner;
use App\Models\ProfilBeranda;
use App\Models\VendorProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(Request $request)
    {

        // Menghitung total seluruh UMKM dari tabel identitasusaha
        $totalUMKM = DB::table('identitasusaha')->count();
        $videoProfil = ProfilBeranda::latest()->first();
        $popup = PopupBanner::where('status', 1)->latest()->first();

        // Menghitung jumlah kecamatan yang unik (distinct)
        $jumlahKecamatan = DB::table('identitasusaha')
            ->whereNotNull('kecamatan')
            ->where('kecamatan', '!=', '')
            ->distinct('kecamatan')
            ->count('kecamatan');

        return view('frontend.beranda.index', compact('totalUMKM', 'jumlahKecamatan', 'videoProfil', 'popup'));
    }

    public function listPanel()
    {

        return view('frontend.panel.index');
    }

    public function eLearning()
    {

        $elearnings = Elearning::where('is_publish', 1)->latest()->paginate(10);

        return view('frontend.elearning.index', compact('elearnings'));
    }

    public function detailElearning($id)
    {

        $elearning = Elearning::findOrFail($id);
        $elearning->views = $elearning->views + 1;
        $elearning->save();
        $elearningsElse = Elearning::where('is_publish', 1)
            ->where('id', '!=', $id)
            ->latest()
            ->paginate(10);

        return view('frontend.elearning.detail', compact('elearning', 'elearningsElse'));
    }

    // public function eCommerce(){

    //     $produks = VendorProduk::orderByDesc('id')->paginate(10)->withQueryString();
    //     $categories = KategoriProduk::orderByDesc('id')->limit(6)->get();

    //     return view('frontend.ecommerce.index', compact('produks', 'categories'));
    // }

    public function eCommerce(Request $request)
    {
        // Mengambil query dari form filter
        $search    = $request->query('search');
        $kategori  = $request->query('kategori');
        $kecamatan = $request->query('kecamatan');
        $hargaMin  = $request->query('harga_min');
        $hargaMax  = $request->query('harga_max');
        $sort      = $request->query('sort', 'terbaru'); // Default urutkan dari yang terbaru

        // Query Builder dengan Eager Loading
        $query = VendorProduk::with(['vendor', 'kategori']);

        // 1. Filter Pencarian Nama Produk / Deskripsi
        $query->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhere('produk_deskripsi', 'like', '%' . $search . '%');
            });
        });

        // 2. Filter Kategori (Bisa berdasarkan ID Kategori atau Slug/Nama)
        $query->when($kategori, function ($q) use ($kategori) {
            $q->where(function ($sub) use ($kategori) {
                $sub->where('kategori_produk_id', $kategori)
                    ->orWhereHas('kategori', function ($catQuery) use ($kategori) {
                        $catQuery->where('slug', $kategori)
                            ->orWhere('name', 'like', '%' . $kategori . '%');
                    });
            });
        });

        // 3. Filter Kecamatan (Berdasarkan relasi Vendor)
        $query->when($kecamatan, function ($q) use ($kecamatan) {
            $q->whereHas('vendor', function ($vQuery) use ($kecamatan) {
                $vQuery->where('kecamatan', 'like', '%' . $kecamatan . '%');
            });
        });

        // 4. Filter Range Harga Min
        $query->when($hargaMin, function ($q) use ($hargaMin) {
            $q->where('harga', '>=', $hargaMin);
        });

        // 5. Filter Range Harga Max
        $query->when($hargaMax, function ($q) use ($hargaMax) {
            $q->where('harga', '<=', $hargaMax);
        });

        // 6. Sorting / Pengurutan
        switch ($sort) {
            case 'harga_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'terbaru':
            default:
                $query->orderByDesc('id');
                break;
        }

        // Ambil data dengan pagination & pertahankan query string di URL
        $produks = $query->paginate(9)->withQueryString();

        // Data Kategori
        $categories = KategoriProduk::orderByDesc('id')->limit(6)->get();

        return view('frontend.ecommerce.index', compact('produks', 'categories'));
    }

    public function eCommerceDetail()
    {

        return view('frontend.ecommerce.detailProduk');
    }
    public function cartList()
    {



        return view('frontend.ecommerce.cartList');
    }

    public function kategoriProduk()
    {

        return view('frontend.ecommerce.kategori.index');
    }

    public function koperasi()
    {

        return view('frontend.koperasi.index');
    }

    public function tambahUmkm()
    {

        return view('frontend.daftarUMKM.index');
    }

    // nanti memakai id
    public function toko()
    {

        return view('frontend.ecommerce.toko.index');
    }

    public function alamatSaya()
    {
        return view('frontend.alamat.index');
    }


    public function checkout()
    {


        return view('frontend.checkout.index');
    }

    public function ulasan()
    {
        return view('frontend.ecommerce.ulasan');
    }

    public function transaksiDetail()
    {
        return view('frontend.ecommerce.detailTransaksi');
    }

    public function acara()
    {
        $acaras = \App\Models\Acara::where('tanggal_acara', '>=', now())->latest()->paginate(6);
        return view('frontend.acara.index', compact('acaras'));
    }

    public function detailAcara($id)
    {
        $acara = \App\Models\Acara::findOrFail($id);
        return view('frontend.acara.detailAcara', compact('acara'));
    }

    public function pelatihan()
    {

        $categories = KategoriPelatihan::orderByDesc('id')->get();
        $pelatihan = Pelatihan::orderByDesc('id')->paginate(10)->withQueryString();
        return view('frontend.pelatihan.index', compact('pelatihan', 'categories'));
    }

    public function detailPelatihan($id)
    {
        $pelatihan = Pelatihan::findOrFail($id)->first();
        return view('frontend.pelatihan.detailPelatihan', compact('pelatihan'));
    }

    public function daftarPelatihan()
    {
        return view('frontend.pelatihan.daftarPelatihan');
    }

    public function informasiBPOM()
    {
        return view('frontend.informasiBPOM.index');
    }

    public function edukasiKeuangan()
    {
        return view('frontend.edukasiKeuangan.index');
    }

    public function detailEdukasiKeuangan()
    {
        return view('frontend.edukasiKeuangan.detail');
    }

    public function berita()
    {
        $beritas = Berita::where('is_published', 1)->latest()->paginate(10);
        return view('frontend.berita.index', compact('beritas'));
    }

    public function detailBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('frontend.berita.detailBerita', compact('berita'));
    }
}
