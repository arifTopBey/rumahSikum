<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\EventMaterial;
use App\Models\EventMaterialProgress;
use App\Models\EventOrganizer;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelatihanController extends Controller
{
    public function index()
    {

        // $pelatihanRegistrasi = EventRegistration::where('user_id', auth()->user()->id)->first();
        // $elearning = EventOrganizer::where('id', $pelatihanRegistrasi->event_organizer_id)->get();

        $userId = Auth::id();

        $pelatihanRegistrasi = EventRegistration::where('user_id', $userId)->get();
        $eventIds = $pelatihanRegistrasi->pluck('event_organizer_id');
        $elearning = EventOrganizer::whereIn('id', $eventIds)->get();


        foreach ($elearning as $event) {

            // Cari registrasi user untuk event ini
            $registration = $pelatihanRegistrasi
                ->firstWhere('event_organizer_id', $event->id);

            // Total materi event
            $totalMateri = EventMaterial::where(
                'event_organizer_id',
                $event->id
            )->count();

            // Materi yang sudah diselesaikan user
            $materiSelesai = EventMaterialProgress::where(
                'event_registration_id',
                $registration->id
            )
                ->where('user_id', $userId)
                ->whereNotNull('completed_at')
                ->count();

            // Hitung persentase
            $progress = $totalMateri > 0
                ? round(($materiSelesai / $totalMateri) * 100)
                : 0;

            // Tambahkan data ke object event
            $event->registration = $registration;
            $event->total_materi = $totalMateri;
            $event->materi_selesai = $materiSelesai;
            $event->progress_percentage = $progress;

            // Status belajar
            if ($progress >= 100 && $totalMateri > 0) {
                $event->progress_status = 'selesai';
            } elseif ($progress > 0) {
                $event->progress_status = 'berjalan';
            } else {
                $event->progress_status = 'belum_mulai';
            }
        }

        return view('vendor.pelatihan.index', compact('elearning', 'pelatihanRegistrasi'));
    }
}
