<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PelatihanStoreRequest;
use App\Http\Requests\Admin\PelatihanUpdateRequest;
use App\Models\EventMaterial;
use App\Models\EventMaterialProgress;
use App\Models\EventRegistration;
use App\Models\KategoriPelatihan;
use App\Models\Pelatihan;
use Barryvdh\DomPDF\Facade\Pdf;
// use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihan = Pelatihan::latest()->paginate(10);
        return view('admin.pelatihan.index', compact('pelatihan'));
    }

    public function create()
    {
        $categories = KategoriPelatihan::all();
        return view('admin.pelatihan.createPelatihan', compact('categories'));

    }


    public function store(PelatihanStoreRequest $request)
    {

        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $acara = new Pelatihan();
            $acara->kategori_pelatihan_id = $validated['kategori_pelatihan_id'];
            $acara->judul = $validated['judul'];
            $acara->slug = Str::slug($validated['judul']);
            $acara->deskripsi = $validated['deskripsi'];
            $acara->lokasi = $validated['lokasi'];
            $acara->tanggal_acara = $validated['tanggal_acara'];
            $acara->waktu_acara_mulai = $validated['waktu_acara_mulai'];
            $acara->waktu_acara_selesai = $validated['waktu_acara_selesai'];
            // $acara->kuota = $validated['kuota'];
            $acara->views = 0;
            // $acara->gambar = $validated['gambar']->store('acara', 'public');
            $acara->gambar = $validated['gambar']->store('pelatihan', 'local');
            $acara->save();
            DB::commit();
            return redirect()->route('admin.pelatihan.index')->with('success', 'Pelatihan berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan Pelatihan: ' . $e->getMessage());
        }

    }

    public function show($id)
    {

        $pelatihan = Pelatihan::findOrFail($id);
        return view('admin.pelatihan.detail', compact('pelatihan'));
    }

    public function edit($id)
    {

        $pelatihan = Pelatihan::findOrFail($id);
        $categories = KategoriPelatihan::all();

        return view('admin.pelatihan.edit', compact('pelatihan', 'categories'));
    }

    public function update(PelatihanUpdateRequest $request, $id)
    {

        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $acara = Pelatihan::findOrFail($id);
            $acara->kategori_pelatihan_id = $validated['kategori_pelatihan_id'];
            $acara->judul = $validated['judul'];
            $acara->slug = Str::slug($validated['judul']);
            $acara->deskripsi = $validated['deskripsi'];
            $acara->lokasi = $validated['lokasi'];
            $acara->tanggal_acara = $validated['tanggal_acara'];
            $acara->waktu_acara_mulai = $validated['waktu_acara_mulai'];
            $acara->waktu_acara_selesai = $validated['waktu_acara_selesai'];

            if ($request->hasFile('gambar')) {
                if ($acara->gambar) {
                    // Storage::disk('public')->delete($acara->gambar);
                    Storage::disk('local')->delete($acara->gambar);
                }
                $acara->gambar = $validated['gambar']->store('pelatihan', 'local');

            }

            $acara->save();
            DB::commit();
            return redirect()->route('admin.pelatihan.index')->with('success', 'Pelatihan berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate pelatihan: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $pelatihan = Pelatihan::findOrFail($id);

            if ($pelatihan->gambar) {

                // Storage::disk('public')->delete($acara->gambar);
                Storage::disk('local')->delete($pelatihan->gambar);

            }
            $pelatihan->delete();

            DB::commit();
            return redirect()->route('admin.pelatihan.index')->with('success', 'Pelatihan berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Pelatihan: ' . $e->getMessage());
        }
    }

    // showFotoPelatihan
    public function showFotoPelatihan($path)
    {
        // Debug: Jika gambar tidak muncul, hapus komentar dd dibawah ini untuk cek path yang masuk
        // dd($path); 

        if (!Storage::disk('local')->exists($path)) {
            abort(404, "File tidak ada di storage/app/" . $path);
        }

        return Storage::disk('local')->response($path);
    }

    public function downloadSertifikat2($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);
        // dd(FacadesAuth::id()); // 11
        // dd( $registration); //8 ! ===

        // Pastikan sertifikat hanya bisa diakses oleh pemiliknya
        if ($registration->user_id !== FacadesAuth::id()) {
            abort(403);
        }

        // Total materi event
        $totalMateri = EventMaterial::where(
            'event_organizer_id',
            $registration->event_organizer_id
        )->count();

        // Materi yang sudah selesai
        $materiSelesai = EventMaterialProgress::where(
            'event_registration_id',
            $registration->id
        )
            ->whereNotNull('completed_at')
            ->count();

        // Belum selesai semua
        if ($totalMateri == 0 || $materiSelesai < $totalMateri) {
            abort(403, 'Pelatihan belum selesai.');
        }

        $event = $registration->eventOrganizer;

        // Nomor sertifikat
        $nomorSertifikat = 'CERT-' . date('Y') . '-' . str_pad($registration->id, 5, '0', STR_PAD_LEFT);

        // Template Word
        $templatePath = storage_path('app/private/templates/sertifikat.docx');

        if (!file_exists($templatePath)) {
            abort(404, 'Template sertifikat tidak ditemukan.');
        }

        $template = new TemplateProcessor($templatePath);

        $template->setValue('NAMA_PESERTA', $registration->nama);
        $template->setValue('NAMA_PELATIHAN', $event->judul_event);
        $template->setValue('NAMA_PENYELENGGARA', config('app.name'));
        $template->setValue('PERIODE_PELATIHAN', Carbon::parse($event->waktu_mulai)->format('d M Y') . ' - ' . Carbon::parse($event->waktu_selesai)->format('d M Y'));
        $template->setValue('DURASI_PELATIHAN', Carbon::parse($event->waktu_mulai)->diffInHours(Carbon::parse($event->waktu_selesai)) . ' Jam');
        $template->setValue('TANGGAL_SERTIFIKAT', now()->format('d M Y'));
        $template->setValue('NOMOR_SERTIFIKAT', $nomorSertifikat);
        // Temporary DOCX
        $tempDir = storage_path('app/private/certificates');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $fileName = 'sertifikat-' . Str::slug($registration->nama) . '-' . $registration->id;
        $docxPath = $tempDir . '/' . $fileName . '.docx';
        $template->saveAs($docxPath);

        // Convert DOCX -> PDF menggunakan LibreOffice
        $command = sprintf(
            'libreoffice --headless --convert-to pdf --outdir %s %s',
            escapeshellarg($tempDir),
            escapeshellarg($docxPath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            abort(500, 'Gagal membuat sertifikat PDF.');
        }

        $pdfPath = $tempDir . '/' . $fileName . '.pdf';

        if (!file_exists($pdfPath)) {
            abort(500, 'File sertifikat tidak berhasil dibuat.');
        }

        // Hapus DOCX sementara
        unlink($docxPath);

        return response()->download($pdfPath, $fileName . '.pdf', ['Content-Type' => 'application/pdf',])->deleteFileAfterSend(true);
    }

    public function downloadSertifikat3($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);

        // Pastikan sertifikat hanya bisa diakses oleh pemiliknya
        if ($registration->user_id !== FacadesAuth::id()) {
            abort(403);
        }

        // Total & progress materi
        $totalMateri = EventMaterial::where('event_organizer_id', $registration->event_organizer_id)->count();
        $materiSelesai = EventMaterialProgress::where('event_registration_id', $registration->id)
            ->whereNotNull('completed_at')
            ->count();

        if ($totalMateri == 0 || $materiSelesai < $totalMateri) {
            abort(403, 'Pelatihan belum selesai.');
        }

        $event = $registration->eventOrganizer;
        $nomorSertifikat = 'CERT-' . date('Y') . '-' . str_pad($registration->id, 5, '0', STR_PAD_LEFT);

        $data = [
            'nama_peserta' => $registration->nama,
            'nama_pelatihan' => $event->judul_event,
            'penyelenggara' => config('app.name'),
            'periode' => Carbon::parse($event->waktu_mulai)->format('d M Y') . ' - ' . Carbon::parse($event->waktu_selesai)->format('d M Y'),
            'durasi' => Carbon::parse($event->waktu_mulai)->diffInHours(Carbon::parse($event->waktu_selesai)) . ' Jam',
            'tanggal' => now()->format('d M Y'),
            'nomor_sertifikat' => $nomorSertifikat,
        ];

        // Load Blade template untuk sertifikat (misal: resources/views/pdf/sertifikat.blade.php)
        $pdf = Pdf::loadView('pdf.sertifikat', $data)->setPaper('a4', 'landscape');

        $fileName = 'sertifikat-' . Str::slug($registration->nama) . '-' . $registration->id . '.pdf';

        return $pdf->download($fileName);
    }

    public function downloadSertifikat($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);
        // dd(FacadesAuth::id());
        // dd($registration->user_id);

        // Pastikan sertifikat hanya bisa diakses oleh pemiliknya
        if ($registration->user_id !== FacadesAuth::id()) {
            abort(403);
        }

        // Total materi event
        $totalMateri = EventMaterial::where(
            'event_organizer_id',
            $registration->event_organizer_id
        )->count();

        // Materi yang sudah selesai
        // $materiSelesai = EventMaterialProgress::where(
        //     'event_registration_id',
        //     $registration->id
        // )
        //     ->whereNotNull('completed_at')
        //     ->count();

        $materiSelesai = EventMaterialProgress::where('event_registration_id', $registration->id)
    ->where('user_id', FacadesAuth::id()) // <-- TAMBAHKAN INI AGAR LEBIH AMAN
    ->whereNotNull('completed_at')
    ->count();

        // Belum selesai semua
        if ($totalMateri == 0 || $materiSelesai < $totalMateri) {
            abort(403, 'Pelatihan belum selesai.');
        }

        $event = $registration->eventOrganizer;
        // dd($event->judul_event);

        // Nomor sertifikat
        $nomorSertifikat = 'CERT-' . date('Y') . '-' . str_pad($registration->id, 5, '0', STR_PAD_LEFT);

        // Template Word
        $templatePath = storage_path('app/private/templates/sertifikat.docx');

        if (!file_exists($templatePath)) {
            abort(404, 'Template sertifikat tidak ditemukan.');
        }

        // Isikan data ke template DOCX
        $template = new TemplateProcessor($templatePath);

        $template->setValue('NAMA_PESERTA', $registration->nama);
        $template->setValue('NAMA_PELATIHAN', $event->judul_event);
        $template->setValue('NAMA_PENYELENGGARA', 'OPENCLASS ACADEMY');
        $template->setValue('PERIODE_PELATIHAN', Carbon::parse($event->waktu_mulai)->format('d M Y') . ' - ' . Carbon::parse($event->waktu_selesai)->format('d M Y'));
        $template->setValue('DURASI_PELATIHAN', Carbon::parse($event->waktu_mulai)->diffInHours(Carbon::parse($event->waktu_selesai)) . ' Jam');
        $template->setValue('TANGGAL_SERTIFIKAT', now()->format('d M Y'));
        $template->setValue('NAMA_PENANGGUNG_JAWAB', "ADMIN RUMAH SIKUM");
        $template->setValue('NOMOR_SERTIFIKAT', $nomorSertifikat);

        // Buat folder temporary jika belum ada
        $tempDir = storage_path('app/private/certificates');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Nama file akhir (.docx)
        $fileName = 'sertifikat-' . Str::slug($registration->nama) . '-' . $registration->id . '.docx';
        $docxPath = $tempDir . '/' . $fileName;

        // Simpan file DOCX sementara
        $template->saveAs($docxPath);

        // Header khusus agar browser membaca file sebagai Word (.docx)
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        // Download dan hapus file temporary setelah terunduh
        return response()->download($docxPath, $fileName, $headers)->deleteFileAfterSend(true);
    }

}
