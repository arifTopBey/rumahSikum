<div class="col-md-10 mx-auto rounded-2 mt-2 px-2 py-2 border mb-3">
     @if($data->penghargaan->nama_penghargaan)
        <p class="fw-bold">{{  $data->penghargaan->nama_penghargaan  }}</p>
    @else
        <p class="fw-bold fs-4 text-center">Belum Ada Penghargaan</p>
    @endif
</div>