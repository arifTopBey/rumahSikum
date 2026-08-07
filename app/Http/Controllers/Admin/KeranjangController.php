<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{

    public function index(Request $request){

        // cek session apakah ada yang bernama payment_access
         $invoice =  Order::where('user_id', Auth::id())->orWhere('order_status', 'menunggu_pembayaran')->latest()->first();
        // $invoice = 
        // cek session untuk halaman checkout
          if (session('payment_access') === $invoice->invoice_number) {
    
            return redirect()->route('frontend.payment.instruction', $invoice->invoice_number);
         }
        
        $carts = Keranjang::where('user_id', auth()->user()->id)->get();
        // dd($carts);
        return view('frontend.ecommerce.cart.index', compact('carts'));
    } 
    
     public function store(Request $request){

        DB::beginTransaction();

        try{
            $wishlist = new Keranjang();
            $wishlist->user_id = auth()->user()->id;
            $wishlist->produk_id = $request->produk_id;
            $wishlist->save();

            DB::commit();
            return redirect()->route('frontend.cart.list')->with('success', 'Berhasil Dimasukan Produk ke Keranjang');

        }catch(Exception $e){
            DB::rollBack();
             return redirect()->route('frontend.cart.list')->with('failed', $e->getMessage());
        }
    
    }
    
}
