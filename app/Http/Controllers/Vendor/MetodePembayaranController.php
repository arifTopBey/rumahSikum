<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $vendorId = Auth::user()->vendor->id;

        $bankPayments = VendorPayment::where('vendor_id', $vendorId)
            ->where('type', 'transfer_bank')
            ->latest()
            ->get();

        $qrisPayments = VendorPayment::where('vendor_id', $vendorId)
            ->where('type', 'qris')
            ->latest()
            ->get();

        return view('vendor.payment.index', compact('bankPayments', 'qrisPayments'));
    }

    // Simpan Transfer Bank
    public function storeBank(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|numeric',
            'nama_pemilik' => 'required|string|max:255',
            'logo_bank' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $vendorId = Auth::user()->vendor->id;

        // Non-aktifkan semua bank milik vendor ini terlebih dahulu
        VendorPayment::where('vendor_id', $vendorId)
            ->where('type', 'transfer_bank')
            ->update(['is_active' => false]);

        $logoPath = null;
        if ($request->hasFile('logo_bank')) {
            $logoPath = $request->file('logo_bank')->store('bank_logos', 'local');
        }

        // Simpan bank baru sebagai SATU-SATUNYA yang aktif
        VendorPayment::create([
            'vendor_id' => $vendorId,
            'type' => 'transfer_bank',
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pemilik' => $request->nama_pemilik,
            'logo_bank' => $logoPath,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Rekening bank berhasil ditambahkan dan diaktifkan!');
    }

    // Simpan Transfer Bank
    public function storeBank2(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|numeric',
            'nama_pemilik' => 'required|string|max:255',
            'logo_bank' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_bank')) {
            $logoPath = $request->file('logo_bank')->store('bank_logos', 'local');
        }

        VendorPayment::create([
            'vendor_id' => Auth::user()->vendor->id,
            'type' => 'transfer_bank',
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pemilik' => $request->nama_pemilik,
            'logo_bank' => $logoPath,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Rekening bank berhasil ditambahkan!');
    }

    // Simpan QRIS
    public function storeQris2(Request $request)
    {
        $request->validate([
            'nama_qris' => 'required|string|max:255',
            'gambar_qris' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $qrisPath = $request->file('gambar_qris')->store('qris_codes', 'local');

        VendorPayment::create([
            'vendor_id' => Auth::user()->vendor->id,
            'type' => 'qris',
            'nama_qris' => $request->nama_qris,
            'gambar_qris' => $qrisPath,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Kode QRIS berhasil diunggah!');
    }

    // Simpan QRIS
    public function storeQris(Request $request)
    {
        $request->validate([
            'nama_qris' => 'required|string|max:255',
            'gambar_qris' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $vendorId = Auth::user()->vendor->id;

        // Non-aktifkan semua QRIS milik vendor ini terlebih dahulu
        VendorPayment::where('vendor_id', $vendorId)
            ->where('type', 'qris')
            ->update(['is_active' => false]);

        $qrisPath = $request->file('gambar_qris')->store('qris_codes', 'local');

        // Simpan QRIS baru sebagai SATU-SATUNYA yang aktif
        VendorPayment::create([
            'vendor_id' => $vendorId,
            'type' => 'qris',
            'nama_qris' => $request->nama_qris,
            'gambar_qris' => $qrisPath,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Kode QRIS berhasil diunggah dan diaktifkan!');
    }

    // Toggle Aktif / Non-Aktif
    public function toggleStatus2($id)
    {
        // $payment = VendorPayment::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);
        // $payment->is_active = !$payment->is_active;
        // $payment->save();

        // return response()->json(['success' => true, 'is_active' => $payment->is_active]);
    }

    // Toggle Aktif / Non-Aktif (Hanya 1 yang boleh aktif per type)
    public function toggleStatus($id)
    {
        $vendorId = Auth::user()->vendor->id;
        $payment = VendorPayment::where('vendor_id', $vendorId)->findOrFail($id);

        // Jika tadinya tidak aktif -> aktifkan ini & non-aktifkan yang lain dalam 1 tipe
        if (!$payment->is_active) {
            VendorPayment::where('vendor_id', $vendorId)
                ->where('type', $payment->type)
                ->update(['is_active' => false]);

            $payment->is_active = true;
        } else {
            // Jika sedang aktif lalu di-off kan
            $payment->is_active = false;
        }

        $payment->save();

        return response()->json([
            'success' => true,
            'is_active' => $payment->is_active,
            'type' => $payment->type,
            'payment_id' => $payment->id
        ]);
    }

    // Hapus Metode Bayar
    public function destroy($id)
    {
        $payment = VendorPayment::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);

        if ($payment->logo_bank)
            Storage::delete('local/' . $payment->logo_bank);
        if ($payment->gambar_qris)
            Storage::delete('local/' . $payment->gambar_qris);

        $payment->delete();

        return redirect()->back()->with('success', 'Metode pembayaran berhasil dihapus!');
    }
}
