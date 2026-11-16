<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlipBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FlipBookController extends Controller
{
    public function index()
    {
       $flipbooks = FlipBook::latest()->get();
    
        return view('admin.flipbook.index', compact('flipbooks'));
    }

    public function create()
{
    return view('admin.flipbook.create');
}

public function store(Request $request)
{
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_pdf' => 'required|mimes:pdf|max:20480', // Maks 20MB
            'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // Maks 2MB
        ]);

        try {
            // Store File PDF
            $pdfPath = $request->file('file_pdf')->store('flipbook_pdf', 'local');

            // Store Cover Image
            $coverPath = $request->file('cover_image')->store('flipbook_cover', 'local');

            FlipBook::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file_pdf' => $pdfPath,
                'cover_image' => $coverPath,
            ]);

            return redirect()->route('admin.flipbook.index')->with('success', 'Flipbook berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan flipbook: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $flipbook = FlipBook::findOrFail($id);
        return view('admin.flipbook.show', compact('flipbook'));
    }

    public function edit($id)
    {
        $flipbook = FlipBook::findOrFail($id);
        return view('admin.flipbook.edit', compact('flipbook'));
    }

    public function update(Request $request, $id)
{
        $flipbook = FlipBook::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:20480', // Max 20MB, Opsional
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Max 2MB, Opsional
        ]);

        DB::beginTransaction();
        try{
            
            if ($request->hasFile('file_pdf')) {
                if ($flipbook->file_pdf && Storage::disk('local')->exists($flipbook->file_pdf)) {
                    Storage::disk('local')->delete($flipbook->file_pdf);
                }
                $flipbook->file_pdf = $request->file('file_pdf')->store('flipbook_pdf', 'local');
            }

            // Update Cover Image jika ada gambar baru yang diunggah
            if ($request->hasFile('cover_image')) {
                if ($flipbook->cover_image && Storage::disk('local')->exists($flipbook->cover_image)) {
                    Storage::disk('local')->delete($flipbook->cover_image);
                }
                $flipbook->cover_image = $request->file('cover_image')->store('flipbook_cover', 'local');
            }

            $flipbook->judul = $request->judul;
            $flipbook->deskripsi = $request->deskripsi;
            $flipbook->save();
            DB::commit();
            return redirect()->route('admin.flipbook.index')->with('success', 'Flipbook berhasil diperbarui!');

        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui flipbook: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
{
    $flipbook = FlipBook::findOrFail($id);

    // Hapus file dari penyimpanan lokal
    if ($flipbook->file_pdf && Storage::disk('local')->exists($flipbook->file_pdf)) {
        Storage::disk('local')->delete($flipbook->file_pdf);
    }
    if ($flipbook->cover_image && Storage::disk('local')->exists($flipbook->cover_image)) {
        Storage::disk('local')->delete($flipbook->cover_image);
    }

    $flipbook->delete();

    return redirect()->route('admin.flipbook.index')->with('success', 'Flipbook berhasil dihapus!');
}

}
