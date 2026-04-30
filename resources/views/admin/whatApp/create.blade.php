@extends('admin.main.main')

@section('content')


<div style="min-height: 100vh;" class="container-fluid px-5 bg-white">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif

    <form action="{{ route('whatsapp.send') }}" method="POST">
        @csrf
        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 style="color: #a82282;" class="fw-800 mb-1">Buat WhatApp</h4>
                    <p class="text-muted small mb-0">Atur Nomor Whatapp dan Pesan</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.whatapp.index') }}" class="btn btn-light rounded-pill px-4 fw-bold border">Batal</a>
                    <button  type="submit" style="background-color: #a82282; color: white" class="btn rounded-pill px-4 fw-bold shadow">Kirim WhatApp</button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nomor WhatApp</label>
                        <input type="text" name="no_wa" class="form-control form-control-lg rounded-3 border-2" placeholder="Contoh:086xxxxx" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-bold text-dark">Pesan (Message)</label>
                        <textarea placeholder="Masukan Pesan yang ingin dikirim" name="message" class="form-control" id="exampleFormControlTextarea1" rows="3" style="min-height: 300px;"></textarea>
                    </div>
                </div>
            </div>

           
        </div>
    </form>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();

    // Editor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .fw-800 {
        font-weight: 800;
    }

    .ck-editor__editable {
        min-height: 250px;
        border-radius: 0 0 12px 12px !important;
    }

    .ck-toolbar {
        border-radius: 12px 12px 0 0 !important;
    }
</style>

<script>
   
</script>
@endsection