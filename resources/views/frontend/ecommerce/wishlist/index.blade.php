@extends('frontend.main.index')

@section('content')
<div class="container pb-5" style="margin-top: 110px;">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-5 gap-3 border-bottom pb-3">
        <div>
            <h4 class="fw-800 text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="heart" class="text-danger fill-danger" size="24"></i> Produk Keinginan Saya
            </h4>
            <p class="text-muted small mb-0">Kamu menyimpan <span class="fw-bold text-primary">{{ count($wishlists ?? [1,2,3]) }}</span> produk di dalam wishlist Anda.</p>
        </div>
        @if(count($wishlists ?? [1,2,3]) > 0)
        <div>
            <button class="btn btn-outline-primary rounded-3 fw-bold btn-sm py-2 px-3 d-flex align-items-center gap-2 shadow-sm">
                <i data-lucide="shopping-bag" size="16"></i> Pindahkan Semua ke Keranjang
            </button>
        </div>
        @endif
    </div>

    <div class="row g-4">
        @foreach ($wishlists as $wishlist ) 
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative transition-hover">


                
                    <form id="delete-form-{{ $wishlist->id }}" action="{{ route('frontend.wishlist.produk.delete', $wishlist->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button  onclick="confirmDelete('{{ $wishlist->id }}', '{{ $wishlist->produk->nama_produk }}')" type="button" class="remove-wishlist-btn border-0 shadow-sm" title="Hapus dari Wishlist">
                            <i data-lucide="x" size="16"></i>
                        </button>
                    </form>
                

                    <a href="#" class="text-decoration-none text-dark">
                        <div class="product-img-wrapper position-relative overflow-hidden">
                            <img src="{{ route('show.thumbnail.produk.private', $wishlist->produk->produk_thumbnail) }}"
                                class="w-100 product-img" alt="Tas" style="height: 200px; object-fit: cover;">
                            <span class="badge-location position-absolute bottom-0 start-0 m-3">
                                <i data-lucide="map-pin" size="12" class="me-1"></i>{{ $wishlist->produk->vendor->kecamatan }}
                            </span>
                        </div>
                        
                        <div class="card-body p-3">
                            <p class="smaller text-muted text-uppercase fw-bold mb-1">{{ $wishlist->produk->nama_produk }}</p>
                            <h6 class="fw-bold text-dark text-truncate mb-1">{!!   $wishlist->produk->produk_deskripsi !!}</h6>
                            
                            <!-- <span class="smaller text-success fw-semibold d-block mb-2">
                                <i data-lucide="check" size="12" class="me-1"></i>Stok Tersedia
                            </span> -->

                            <div class="d-flex justify-content-between align-items-center mt-2 border-top pt-2">
                                <div>
                                    <span class="smaller text-muted d-block">Harga</span>
                                    <span class="price-text fw-800 text-primary">Rp {{ number_format($wishlist->produk->harga, 0) }}</span>
                                </div>
                                <button class="btn btn-primary rounded-3 p-2 shadow-sm" title="Masukkan Keranjang">
                                    <i data-lucide="shopping-cart" size="16"></i>
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.72rem; letter-spacing: 0.05rem; }

    /* Isi Hati Merah di Judul */
    .fill-danger { fill: #ef4444; }

    /* Animasi Hover Kartu Produk */
    .product-card { background: white; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .product-img { transition: transform 0.5s ease; }
    .product-card:hover .product-img { transform: scale(1.06); }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 12px 20px rgba(0,0,0,0.06) !important; }

    .remove-wishlist-btn {
        position: absolute; top: 12px; right: 12px; z-index: 10;
        background: white; color: #64748b; width: 32px; height: 32px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .remove-wishlist-btn:hover { color: #ffffff; background: #ef4444; }

    /* Badge Wilayah */
    .badge-location {
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(4px);
        color: #1e293b; padding: 4px 10px; border-radius: 6px;
        font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center;
    }

    .price-text { font-size: 1rem; }
</style>

<script>
    lucide.createIcons();
</script>
@endsection