<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventOrganizer;
use App\Models\EventRegistration;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {


        // =============== logic vendor dashboard ================
        if (auth()->user()->user_role == 'vendor') {

            $vendorId = Auth::user()->vendor->id; // Mengambil ID Vendor terautentikasi

            // Total Pendapatan dari Pesanan yang Selesai
            $totalPendapatan = Order::whereHas('details', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
                ->where('order_status', 'selesai')
                ->sum('total_payment');

            // Jumlah Pesanan Perlu Diproses / Dikemas
            $pesananPending = Order::whereHas('details', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
                ->where('payment_status', 'paid')
                ->where('order_status', 'diproses')
                ->count();

            // Jumlah Pesanan Selesai
            $pesananSelesai = Order::whereHas('details', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
                ->where('order_status', 'selesai')
                ->count();

            // Total Produk Milik Vendor
            $totalProduk = VendorProduk::where('vendor_id', $vendorId)->count();

            // 5 Pesanan Terbaru Masuk
            $recentOrders = Order::whereHas('details', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
                ->with(['user', 'details' => function ($q) use ($vendorId) {
                    $q->where('vendor_id', $vendorId)->with('produk');
                }])
                ->latest()
                ->take(5)
                ->get();

            return view('vendor.dashboard.index',compact(
            'totalPendapatan',
            'pesananPending',
            'pesananSelesai',
            'totalProduk',
            'recentOrders',
         ));
        }elseif(auth()->user()->user_role == 'user') {
            $userId = Auth::id();

            // Hitung status pesanan user
            $countPending = Order::where('user_id', $userId)
                ->where('payment_status', 'pending')
                ->count();

            $countDiproses = Order::where('user_id', $userId)
                ->where('payment_status', 'paid')
                ->where('order_status', 'diproses')
                ->count();

            $countDikirim = Order::where('user_id', $userId)
                ->where('order_status', 'dikirim')
                ->count();

            $countSelesai = Order::where('user_id', $userId)
                ->where('order_status', 'selesai')
                ->count();

            // 5 Pesanan Terakhir
            $recentOrders = Order::where('user_id', $userId)
                ->with('details.produk')
                ->latest()
                ->take(5)
                ->get();

            return view('user_dashboard.index', compact(
                'countPending',
                'countDiproses',
                'countDikirim',
                'countSelesai',
                'recentOrders'
            ));
        }else{
            // 1. Data Ringkasan Stat Cards
            $totalRevenue = Order::where('payment_status', 'paid')->sum('total_payment');
            $totalUmkm = Vendor::where('status_store', 1)->count();
            $pendingUmkmCount = Vendor::where('status_store', 0)->count();
            $totalProducts = VendorProduk::count();
            $totalOrders = Order::count();
            $pendingOrdersCount = Order::where('order_status', 'pending')->count();

            // 2. Data UMKM Menunggu Persetujuan (Pending Approvals)
            $pendingUmkms = Vendor::where('status_store', 0)
                ->latest()
                ->take(5)
                ->get();

            // 3. Transaksi Terbaru
            $recentOrders = Order::with(['user', 'details.produk'])
                ->latest()
                ->take(5)
                ->get();

            $idActive = Auth::user()->id;

            $user = User::where('id', $idActive)->first();
            $email = User::where('email', $user->email)->first();

            if($email->email == 'AdminElearning1@gmail.com'){

                $elearning = EventOrganizer::orderByDesc('id')->paginate(10);
                $registered = EventRegistration::orderByDesc('id')->paginate(10);

                // dd($elearning);

                return view('admin.dashboardElearning.index', compact('elearning', 'registered'));

            }else{
                return view('admin.userDashboard.index', compact(
                   'totalRevenue',
                   'totalUmkm',
                   'pendingUmkmCount',
                   'totalProducts',
                   'totalOrders',
                   'pendingOrdersCount',
                   'pendingUmkms',
                   'recentOrders'
               ));

            }



                // userDashboard
        }


       
    }
}
