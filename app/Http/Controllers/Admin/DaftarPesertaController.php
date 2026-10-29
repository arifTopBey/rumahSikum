<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventMaterial;
use App\Models\EventOrganizer;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class DaftarPesertaController extends Controller
{
    public function index()
    {

        $elearning = EventOrganizer::orderByDesc('id')->paginate(10);
        $totalPeserta = EventRegistration::count();

        return view('admin.laporan.index', compact('elearning', 'totalPeserta'));
    }

    public function daftarPeserta($id)
    {

        $elearning = EventOrganizer::findOrFail($id);

        // Total materi dalam event
        $totalMateri = EventMaterial::where('event_organizer_id', $id)->count();

        // Ambil peserta + jumlah materi yang sudah selesai
        $daftarPeserta = EventRegistration::where('event_organizer_id', $id)
            ->withCount([
                'progress as materi_selesai_count' => function ($query) {
                    $query->whereNotNull('completed_at');
                }
            ])
            ->paginate(10);

        // Ambil semua peserta untuk menghitung statistik
        $semuaPeserta = EventRegistration::where('event_organizer_id', $id)
            ->withCount([
                'progress as materi_selesai_count' => function ($query) {
                    $query->whereNotNull('completed_at');
                }
            ])
            ->get();

        $totalPeserta = $semuaPeserta->count();

        // Peserta yang sudah menyelesaikan semua materi
        $pesertaSelesai = $semuaPeserta->filter(function ($peserta) use ($totalMateri) {
            return $totalMateri > 0 &&
                $peserta->materi_selesai_count >= $totalMateri;
        })->count();

        // Peserta yang belum menyelesaikan semua materi
        $pesertaBelumSelesai = $totalPeserta - $pesertaSelesai;

        return view('admin.peserta.index', compact(
            'elearning',
            'daftarPeserta',
            'totalMateri',
            'totalPeserta',
            'pesertaSelesai',
            'pesertaBelumSelesai'
        ));
    }
}
