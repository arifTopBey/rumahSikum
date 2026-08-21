<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Berita;
use App\Models\Elearning;
use App\Models\EventMaterial;
use App\Models\EventMaterialProgress;
use App\Models\EventOrganizer;
use App\Models\EventRegistration;
use App\Models\KategoriPelatihan;
use App\Models\KategoriProduk;
use App\Models\Pelatihan;
use App\Models\PopupBanner;
use App\Models\ProfilBeranda;
use App\Models\Vendor;
use App\Models\VendorProduk;
use Illuminate\Console\Scheduling\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function eLearning2()
    {

        $elearnings = Elearning::where('is_publish', 1)->latest()->paginate(10);

        return view('frontend.elearning.index', compact('elearnings'));
    }
    public function eLearning()
    {

        $elearnings = EventOrganizer::where('is_publish', 1)->latest()->paginate(10);

        return view('frontend.elearning.index', compact('elearnings'));
    }

    public function detailElearning2($id)
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
    public function detailElearning($id)
    {
        $eventRegister = "";
        $completedMaterialIds = collect();

        $elearning = EventOrganizer::findOrFail($id);
        $modules = EventMaterial::where('event_organizer_id', $elearning->id)->get();

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $registered = EventRegistration::where('user_id', $userId)->where('event_organizer_id', $elearning->id)->first();
            $eventRegister = $registered;
        }

        if (Auth::check()) {

            // Kalau sudah terdaftar, ambil materi yang sudah selesai
            if ($eventRegister) {

                $completedMaterialIds = EventMaterialProgress::where(
                    'event_registration_id',
                    $eventRegister->id
                )
                    ->where('user_id', Auth::id())
                    ->whereNotNull('completed_at')
                    ->pluck('event_material_id');
            }
        }

        // Tandai setiap modul apakah sudah selesai
        $modules->each(function ($modul) use ($completedMaterialIds) {

            $modul->is_completed = $completedMaterialIds
                ->contains($modul->id);
        });

        // Total materi
        $totalModules = $modules->count();

        // Total materi yang sudah selesai
        $completedModulesCount = $completedMaterialIds->count();

        // Hitung persentase
        $progressPercentage = $totalModules > 0
            ? round(($completedModulesCount / $totalModules) * 100)
            : 0;

        return view('frontend.elearning.detail', compact('elearning', 'modules', 'eventRegister', 'completedModulesCount','progressPercentage'));
    }

    public function detailModul($id, $idModul)
    {

        $eventRegister = "";
        $elearning = EventOrganizer::where('id', $id)->first();
        $modul = EventMaterial::where('event_organizer_id', $elearning->id)->where('id', $idModul)->first();
        // $modul = EventMaterial::where('event_organizer_id', $id)->where('id', $idModul)->first();

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $registered = EventRegistration::where('user_id', $userId)->where('event_organizer_id', $elearning->id)->first();
            $eventRegister = $registered;
        }

        $prevModul = EventMaterial::where('event_organizer_id', $id)
            ->where('id', '<', $modul->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextModul = EventMaterial::where('event_organizer_id', $id)
            ->where('id', '>', $modul->id)
            ->orderBy('id', 'asc')
            ->first();
        $progress = null;
        if (Auth::check()) {

            if ($eventRegister) {

                $progress = EventMaterialProgress::where(
                    'event_registration_id',
                    $eventRegister->id
                )
                    ->where('event_material_id', $modul->id)
                    ->where('user_id', Auth::id())
                    ->first();
            }
        }


        return view('frontend.elearning.detailModul', compact('elearning', 'modul', 'prevModul', 'nextModul', 'eventRegister', 'progress'));

    }

    public function daftarMateri($id)
    {

        $eventRegister = "";
        // $userId = Auth::user()->id;
        $elearning = EventOrganizer::findOrFail($id);
        // $eventRegister = EventRegistration::where('user_id', $userId)->where('event_organizer_id', $elearning->id)->first();
        $modules = EventMaterial::where('event_organizer_id', $elearning->id)->get();

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $registered = EventRegistration::where('user_id', $userId)->where('event_organizer_id', $elearning->id)->first();
            $eventRegister = $registered;
        }

        return view('frontend.elearning.daftarEvent.index', compact('elearning', 'modules', 'eventRegister'));

    }

    // public function eCommerce(){

    //     $produks = VendorProduk::orderByDesc('id')->paginate(10)->withQueryString();
    //     $categories = KategoriProduk::orderByDesc('id')->limit(6)->get();

    //     return view('frontend.ecommerce.index', compact('produks', 'categories'));
    // }

    public function eCommerce(Request $request)
    {
        // Mengambil query dari form filter
        $search = $request->query('search');
        $kategori = $request->query('kategori');
        $kecamatan = $request->query('kecamatan');
        $hargaMin = $request->query('harga_min');
        $hargaMax = $request->query('harga_max');
        $sort = $request->query('sort', 'terbaru'); // Default urutkan dari yang terbaru

        // Query Builder dengan Eager Loading
        $query = VendorProduk::with(['vendor', 'kategori'])->where('status', 'approved')->Where('status_produk', 1);

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

    public function eCommerceDetail($id)
    {

        // Cari produk berdasarkan ID beserta relasi vendor & kategori
        $produk = VendorProduk::with(['vendor', 'kategori'])
            ->where('id', $id)
            ->firstOrFail();

        // Ambil produk terkait dari kategori atau vendor yang sama untuk rekomendasi (opsional)
        $relatedProducts = VendorProduk::where('kategori_produk_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.ecommerce.detailProduk', compact('produk', 'relatedProducts'));
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
    public function toko(Request $request, $id)
    {

        $vendor = Vendor::findOrFail($id);

        // Filter query produk
        $query = VendorProduk::with('kategori')->where('vendor_id', $id);

        // Filter kategori jika dipilihh
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        // Sorting
        if ($request->sort == 'price_low') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort == 'price_high') {
            $query->orderBy('harga', 'desc');
        } else {
            $query->latest();
        }

        $produks = $query->paginate(9);

        // Total produk vendor & Daftar Kategori yang dipakai produk vendor ini
        $totalProduk = VendorProduk::where('vendor_id', $id)->count();
        $kategories = KategoriProduk::whereHas('produk', function ($q) use ($id) {
            $q->where('vendor_id', $id);
        })->get();

        return view('frontend.ecommerce.toko.index', compact('vendor', 'produks', 'totalProduk', 'kategories'));
    }
    public function toko2($id)
    {

        // 1. Ambil data vendor/toko
        $vendor = Vendor::findOrFail($id);

        // 2. Ambil produk milik vendor tersebut dengan pagination
        $produks = VendorProduk::with('kategori')
            ->where('vendor_id', $id)
            ->latest()
            ->paginate(12);


        $totalProduk = VendorProduk::where('vendor_id', $id)->count();

        return view('frontend.ecommerce.toko.index', compact('vendor', 'produks', 'totalProduk'));
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
