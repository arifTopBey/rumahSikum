<div class="col-md-10 mx-auto rounded-2 mt-2 px-2 py-2 border mb-3">
    @if($data->penghargaan->catatan)
        <p class="fw-bold">{{  $data->penghargaan->catatan  }}</p>
    @else
        <p class="fw-bold fs-4 text-center">Belum Ada Catatan</p>
    @endif
    <!-- <p class="mt-3 fs-5 fw-bold text-muted">Tidak</p> -->
</div>