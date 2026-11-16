@extends('frontend.main.index')

@section('content')
<div class="bg-light min-vh-100 py-4 mt-5">
    <div class="container py-3">

        {{-- Header Navigation & Information --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3 bg-white p-3 p-md-4 rounded-4 shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('frontend.flipbook.index') }}" class="btn btn-light border rounded-3 p-2 d-flex align-items-center justify-content-center text-secondary">
                    <i data-lucide="arrow-left" size="20"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark mb-1">{{ $flipbook->judul }}</h4>
                    <p class="text-muted smaller mb-0">{{ $flipbook->deskripsi ?? 'Modul / Katalog Interaktif' }}</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('show.thumbnail.produk.private', $flipbook->file_pdf) }}" download class="btn btn-outline-danger btn-sm rounded-3 px-3 py-2 fw-semibold smaller d-flex align-items-center gap-1.5">
                    <i data-lucide="download" size="16"></i> Unduh PDF
                </a>
            </div>
        </div>

        {{-- Main Reader Canvas Container --}}
        <div class="card border-0 rounded-4 shadow-lg bg-white overflow-hidden p-3 p-md-5 text-center">
            
            {{-- Loading State --}}
            <div id="pdfLoading" class="py-5">
                <div class="spinner-border text-danger mb-3" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Memuat PDF...</span>
                </div>
                <h6 class="fw-semibold text-dark">Memuat Halaman Flipbook...</h6>
            </div>

            {{-- Flipbook Canvas Viewer Wrapper --}}
            <div class="d-flex justify-content-center align-items-center position-relative w-100 overflow-auto py-2">
                <div id="flipbookContainer" class="shadow-sm rounded-2 overflow-hidden bg-white" style="display: none; max-width: 100%;">
                    <canvas id="pdfCanvas" class="img-fluid border"></canvas>
                </div>
            </div>

            {{-- Bottom Navigation Bar (Sesuai Desain Gambar) --}}
            <div class="d-flex align-items-center justify-content-center gap-3 pt-4 mt-2 border-top">
                <button type="button" 
                        id="prevPage" 
                        class="btn btn-secondary rounded-pill px-4 py-2 fw-semibold smaller border-0 shadow-sm" 
                        style="background-color: #cbd5e1; color: #475569;"
                        disabled>
                    Sebelumnya
                </button>

                <div class="fw-bold text-dark smaller px-2">
                    <span id="pageNum">1</span> / <span id="pageCount">--</span>
                </div>

                <button type="button" 
                        id="nextPage" 
                        class="btn btn-primary rounded-pill px-4 py-2 fw-semibold smaller border-0 shadow-sm" 
                        style="background-color: #6366f1; color: #ffffff;">
                    Selanjutnya
                </button>
            </div>

        </div>

    </div>
</div>

<style>
    .smaller { font-size: 0.85rem; }
    #pdfCanvas {
        max-height: 75vh;
        width: auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-radius: 4px;
    }
</style>

{{-- Library PDF.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();

        const url = "{{ route('show.thumbnail.produk.private', $flipbook->file_pdf) }}";
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        let pdfDoc = null,
            pageNum = 1,
            pageIsRendering = false,
            pageNumIsPending = null;

        const scale = 1.5,
            canvas = document.getElementById('pdfCanvas'),
            ctx = canvas.getContext('2d'),
            prevBtn = document.getElementById('prevPage'),
            nextBtn = document.getElementById('nextPage'),
            pageNumSpan = document.getElementById('pageNum'),
            pageCountSpan = document.getElementById('pageCount'),
            loadingDiv = document.getElementById('pdfLoading'),
            containerDiv = document.getElementById('flipbookContainer');

        // Render Halaman
        const renderPage = num => {
            pageIsRendering = true;

            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale: scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderCtx = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderCtx).promise.then(() => {
                    pageIsRendering = false;

                    if (pageNumIsPending !== null) {
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }
                });

                pageNumSpan.textContent = num;
                updateButtonStates();
            });
        };

        const queueRenderPage = num => {
            if (pageIsRendering) {
                pageNumIsPending = num;
            } else {
                renderPage(num);
            }
        };

        const updateButtonStates = () => {
            prevBtn.disabled = pageNum <= 1;
            nextBtn.disabled = pageNum >= pdfDoc.numPages;

            prevBtn.style.backgroundColor = pageNum <= 1 ? '#e2e8f0' : '#94a3b8';
            prevBtn.style.color = pageNum <= 1 ? '#94a3b8' : '#ffffff';
            
            nextBtn.style.backgroundColor = pageNum >= pdfDoc.numPages ? '#e2e8f0' : '#4f46e5';
            nextBtn.style.color = pageNum >= pdfDoc.numPages ? '#94a3b8' : '#ffffff';
        };

        // Prev Page
        prevBtn.addEventListener('click', () => {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        });

        // Next Page
        nextBtn.addEventListener('click', () => {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        });

        // Load Document PDF
        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            pageCountSpan.textContent = pdfDoc.numPages;

            loadingDiv.style.display = 'none';
            containerDiv.style.display = 'block';

            renderPage(pageNum);
        }).catch(err => {
            loadingDiv.innerHTML = `<p class="text-danger fw-semibold">Gagal memuat dokumen PDF.</p>`;
        });
    });
</script>
@endsection