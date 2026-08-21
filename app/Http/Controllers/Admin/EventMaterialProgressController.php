<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventMaterial;
use App\Models\EventMaterialProgress;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;

class EventMaterialProgressController extends Controller
{
   public function selesaiModul($eventId, $materialId)
{
    $userId = Auth::id();

    // Pastikan user sudah terdaftar di event
    $eventRegister = EventRegistration::where(
        'event_organizer_id',
        $eventId
    )
        ->where('user_id', $userId)
        ->first();

    if (!$eventRegister) {
        return back()->with(
            'error',
            'Anda belum terdaftar pada event ini.'
        );
    }

    // Pastikan materi memang milik event tersebut
    $modul = EventMaterial::where('id', $materialId)
        ->where('event_organizer_id', $eventId)
        ->firstOrFail();

        // Simpan progress
        EventMaterialProgress::updateOrCreate(
            [
                'user_id' => $userId,
                'event_registration_id' => $eventRegister->id,
                'event_material_id' => $modul->id,
            ],
            [
                'completed_at' => now(),
            ]
        );

        // Hitung jumlah seluruh materi event
        $totalMateri = EventMaterial::where(
            'event_organizer_id',
            $eventId
        )->count();

        // Hitung materi yang sudah diselesaikan user
        $materiSelesai = EventMaterialProgress::where(
            'event_registration_id',
            $eventRegister->id
        )
            ->where('user_id', $userId)
            ->whereNotNull('completed_at')
            ->count();

    // Jika semua materi sudah selesai
        if ($totalMateri > 0 && $materiSelesai >= $totalMateri) {

            $eventRegister->update([
                'status' => 'selesai',
            ]);
        } else {

            // Jika sebelumnya belum aktif
            if ($eventRegister->status === 'terdaftar') {
                $eventRegister->update([
                    'status' => 'aktif',
                ]);
            }
        }

    return back()->with(
        'success',
        'Materi berhasil ditandai sebagai selesai.'
    );
}
}
