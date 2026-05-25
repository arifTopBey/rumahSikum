<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{

     public function wishListProduk(){


        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('frontend.ecommerce.wishlist.index', compact('wishlists'));
    }



    public function store(Request $request){

        DB::beginTransaction();

        try{
            $wishlist = new Wishlist();
            $wishlist->user_id = auth()->user()->id;
            $wishlist->produk_id = $request->produk_id;
            $wishlist->save();

            DB::commit();
            return redirect()->route('frontend.wishlist.produk')->with('success', 'Berhasil Dimasukan Produk ke Wishlist');

        }catch(Exception $e){
            DB::rollBack();
             return redirect()->route('frontend.wishlist.produk')->with('failed', $e->getMessage());
        }
    
    }
    
    public function delete($id){

         DB::beginTransaction();

        try{

            $wishlist = Wishlist::findOrFail($id)->first();
            $wishlist->delete();
            DB::commit();
            return redirect()->route('frontend.wishlist.produk')->with('success', 'Wishlih berhasil dihapus');

        }catch(Exception $e){
            DB::rollBack();
             return redirect()->route('frontend.wishlist.produk')->with('failed', $e->getMessage());
        }
    }
}
