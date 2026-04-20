<h3 class="fw-bold text-gray-800 px-3">E. Sebaran Pengusaha Berdasarkan Peringkat Desil pada DTSEN</h3>
<p class="text-xs text-muted mb-6 px-3">Peringkat desil pada Data Tunggal Sosial Ekonomi (DTSEN)
    dibagi menjadi 10 tingkat. Desil merupakan indikator untuk mengelompokan rumah tangga berdasarkan tingkat kesejahteraan dari yang terendah (desil 1) hingga desil tertinggi desil(10). Pemerintah menggunakan peringkat desil tersebut untuk menyalurkan bantuan sosial agar tepat sasaran, dimana desil yang paling rendah menjadi prioritas untuk mendapatkan bantuan</p>

<div class="row mb-5">
    <div class="col-md-10 mx-auto">
        <div class="d-flex mt-3 gap-3 justify-content-center">
            <div class="px-2 d-flex justify-content-center align-items-center">
                <i class="bi bi-shop "
                    style="color:#cc9125; font-size: 70px; display: inline-block;"></i>
            </div>
            <div class="">
                <p style="color: #183252" class="fw-semibold">Total</p>
                <p style="color: #183252" class="fw-bold fs-2">{{ number_format($totalDesil14 + $totalDesil510) }}</p>
                <p class="text-light text-muted">Pengusaha UMKM yang memiliki informasi desil</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 px-5">
                <div class="row px-5 border rounded-2 py-2 shadow-lg ">
                    <div class="col-md-10 ">
                        <p style="color: #183252" class="">Potensi Penerimaan Manfaat Kartu Usaha Afirmatif (Desil 1-4) </p>
                        <p style="color: #183252" class="fw-bold fs-5">{{ number_format($totalDesil14) }}</p>
                        <p style="color: #183252" class="">Pengusaha UMKM</p>
                        <div class="d-flex gap-1">
                            <div class="d-flex gap-2">
                                <div class="">
                                    <i style="color: #183252" class="bi bi-person-standing fs-4"></i>
                                </div>
                                <div class="">
                                    <p class="fw-semibold text-primary ">{{ number_format($laki14) }}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="">
                                    <i class="bi bi-person-standing-dress fs-4 text-danger"></i>
                                </div>
                                <div class="">
                                    <p class="fw-semibold text-primary">{{ number_format($perempuan14) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <i style="color:#cc9125;" class="bi bi-person-video fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-5">
                <div class="row px-5 border rounded-2 py-2 shadow-lg ">
                    <div class="col-md-10 ">
                        <p style="color: #183252" class="">Potensi Penerimaan Manfaat Kartu Usaha Produktif (Desil 5-10) </p>
                        <p style="color: #183252" class="fw-bold fs-5">{{ number_format($totalDesil510) }}</p>
                        <p style="color: #183252" class="">Pengusaha UMKM</p>
                        <div class="d-flex gap-1">
                            <div class="d-flex gap-2">
                                <div class="">
                                    <i style="color: #183252" class="bi bi-person-standing fs-4"></i>
                                </div>
                                <div class="">
                                    <p class="fw-semibold text-primary ">{{ number_format($laki510) }}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="">
                                    <i class="bi bi-person-standing-dress fs-4 text-danger"></i>
                                </div>
                                <div class="">
                                    <p class="fw-semibold text-primary">{{ number_format($perempuan510) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <i style="color:#cc9125;" class="bi bi-person-video fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div style="height: 450px;">
    <canvas id="desilChart"></canvas>
</div>