@extends('frontend.main.index')

@section('content')
  <section class="hero-gradient">
        <div style="min-height: 100vh;" class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <div style="min-height: 400px;" class="bg-white shadow rounded-2 px-2 py-2 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="text-center mb-3">koperasi.co.id</h2>
                        <img src="{{ asset('image/kemenkop.png') }}" alt="" height="150" width="150">                        
                        <p class="text-center mb-3 fw-bold fs-4 mt-2">Dashboard Kementrian Koperasi</p>
                    </div>
                
                </div>
                <div class="col-lg-6 d-none d-flex justify-content-center align-items-center px-5  d-lg-block ">
                     <div style="min-height: 400px;" class="bg-white shadow rounded-2 px-2 py-2 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="text-center mb-3">umkm.co.id</h2>
                        <img src="{{ asset('image/umkm.png') }}" alt="" height="150" width="150">                        
                        <p class="text-center mb-3 fw-bold fs-4 mt-2">Dashboard Usaha Mikro</p>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-flex mx-auto mt-5 justify-content-center align-items-center px-5  d-lg-block ">
                    <div style="min-height: 400px;" class="bg-white shadow rounded-2 px-2 py-2 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="text-center mb-3">kioskum.co.id</h2>
                        <img src="{{ asset('image/kioskum.png') }}" alt="" height="150" width="150">                        
                        <p class="text-center mb-3 fw-bold fs-4 mt-2">Dashboard Data Kioskum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection